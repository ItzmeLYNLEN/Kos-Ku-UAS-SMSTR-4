<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\KamarModel;
use App\Models\PenggunaModel;
use App\Models\ProfilPenghuniModel;

class AdminBookingController extends BaseController
{
    protected $bookingModel;
    protected $kamarModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->kamarModel = new KamarModel();
    }

    public function index()
    {
        $data = [
            'booking' => $this->bookingModel->select('tb_booking.*, tb_kamar.no_kamar, tb_tipe_kamar.harga_dasar')
                                            ->join('tb_kamar', 'tb_kamar.id_kamar = tb_booking.id_kamar')
                                            ->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')
                                            ->orderBy('tb_booking.created_at', 'DESC')
                                            ->findAll()
        ];
        return view('admin/booking/index', $data);
    }

    public function approve($id)
    {
        $booking = $this->bookingModel->find($id);
        $sedangProses = $this->bookingModel->where('id_kamar', $booking['id_kamar'])
                                           ->groupStart()
                                                ->where('status_booking', 'Menunggu DP')
                                                ->orWhere('status_booking', 'Paid')
                                           ->groupEnd()
                                           ->first();

        if ($sedangProses) {
            session()->setFlashdata('pesan_error', 'Gagal! Kamar ini sedang dalam proses pembayaran oleh orang lain.');
            return redirect()->to('/admin/booking');
        }

        $kamar = $this->kamarModel->select('tb_tipe_kamar.harga_dasar')
                                  ->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')
                                  ->where('id_kamar', $booking['id_kamar'])
                                  ->first();

        $nominal_dp = $kamar['harga_dasar'] * 0.5;

        $this->bookingModel->update($id, [
            'status_booking' => 'Menunggu DP',
            'nominal_dp'     => $nominal_dp
        ]);

        $email = \Config\Services::email();
        $email->setTo($booking['email']);
        $email->setSubject('Booking Kamar Si-Kos Disetujui');
        $pesan = "Halo <b>" . $booking['nama_calon'] . "</b>,<br><br>Booking Anda disetujui. Silakan bayar DP di: <a href='" . base_url('track/' . $id) . "'>Link Pembayaran</a>";
        $email->setMessage($pesan);
        $email->send();

        session()->setFlashdata('pesan', 'Booking disetujui dan email terkirim.');
        return redirect()->to('/admin/booking');
    }

    public function createAccount($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $booking = $this->bookingModel->find($id);
        $password_plain = 'kos' . rand(1000, 9999);
        
        $penggunaModel = new PenggunaModel();
        $penggunaModel->insert([
            'username' => $booking['no_wa'],
            'password' => password_hash($password_plain, PASSWORD_BCRYPT),
            'role'     => 'Penghuni'
        ]);

        $id_pengguna = $penggunaModel->getInsertID();
        $profilModel = new ProfilPenghuniModel();
        $profilModel->insert([
            'id_pengguna'  => $id_pengguna,
            'id_kamar'     => $booking['id_kamar'],
            'nama_lengkap' => $booking['nama_calon'],
            'no_wa'        => $booking['no_wa'],
            'email'        => $booking['email']
        ]);

        $this->kamarModel->update($booking['id_kamar'], ['status_kamar' => 'Terisi']);

        $dataKamar = $this->kamarModel->find($booking['id_kamar']);
        $no_kamar_asli = $dataKamar['no_kamar'];

        $calonLain = $this->bookingModel->where('id_kamar', $booking['id_kamar'])
                                         ->where('id_booking !=', $id)
                                         ->findAll();

        foreach ($calonLain as $cl) {
            $email = \Config\Services::email();
            $email->setTo($cl['email']);
            $email->setSubject('Informasi Booking Kamar Si-Kos');
            
            $pesanGagal = "Halo <b>" . $cl['nama_calon'] . "</b>,<br><br>";
            $pesanGagal .= "Kami memohon maaf, kamar yang Anda ajukan (<b>Kamar No. " . $no_kamar_asli . "</b>) saat ini sudah resmi terisi oleh pemesan lain yang lebih dulu menyelesaikan administrasi.<br><br>";
            $pesanGagal .= "Silakan cek katalog kami kembali untuk kamar lainnya yang tersedia.";
            
            $email->setMessage($pesanGagal);
            $email->send();
        }

        $this->bookingModel->where('id_kamar', $booking['id_kamar'])
                           ->where('id_booking !=', $id)
                           ->set(['status_booking' => 'Dibatalkan (Penuh)'])
                           ->update();

        $this->bookingModel->delete($id);
        $db->transComplete();

        $emailSukses = \Config\Services::email();
        $emailSukses->setTo($booking['email']);
        $emailSukses->setSubject('Akun Si-Kos Aktif');
        $emailSukses->setMessage("Akun Anda aktif. Username: " . $booking['no_wa'] . " Password: " . $password_plain);
        $emailSukses->send();

        session()->setFlashdata('pesan', 'Akun dibuat & email notifikasi (berhasil/gagal) telah terkirim.');
        return redirect()->to('/admin/booking');
    }

    public function delete($id)
    {
        $this->bookingModel->delete($id);
        session()->setFlashdata('pesan', 'Satu data booking berhasil dihapus selamanya.');
        return redirect()->to('/admin/booking');
    }

    public function clearCancelled()
    {
        $this->bookingModel->where('status_booking', 'Dibatalkan (Penuh)')->delete();
        session()->setFlashdata('pesan', 'Semua sampah data booking yang batal telah dibersihkan!');
        return redirect()->to('/admin/booking');
    }
}