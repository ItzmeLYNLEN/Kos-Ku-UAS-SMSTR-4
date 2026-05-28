<?php

namespace App\Controllers;

use App\Models\KamarModel;
use App\Models\BookingModel;

class Home extends BaseController
{
    public function index()
    {
        $kamarModel = new KamarModel();
        $semuaKamar = $kamarModel->getKamarTersedia();
        
        $data = [
            'kamar_tersedia' => array_slice($semuaKamar, 0, 4)
        ];
        return view('public/index', $data);
    }

    public function daftarKamar()
    {
        $kamarModel = new KamarModel();
        $data = [
            'kamar_tersedia' => $kamarModel->getKamarTersedia()
        ];
        return view('public/kamar', $data);
    }

    public function submitBooking()
    {
        $bookingModel = new BookingModel();
        $kamarModel = new KamarModel();

        $id_kamar = $this->request->getVar('id_kamar');

        $cekKamar = $kamarModel->find($id_kamar);
        if ($cekKamar['status_kamar'] != 'Tersedia') {
            session()->setFlashdata('pesan_error', 'Maaf, kamar ini baru saja dibooking orang lain.');
            return redirect()->back();
        }

        $bookingModel->insert([
            'id_kamar'       => $id_kamar,
            'nama_calon'     => $this->request->getVar('nama_calon'),
            'no_wa'          => $this->request->getVar('no_wa'),
            'email'          => $this->request->getVar('email'),
            'status_booking' => 'Menunggu Persetujuan'
        ]);

        session()->setFlashdata('pesan_sukses', 'Booking berhasil diajukan! Admin kami akan segera menghubungi Anda melalui WhatsApp atau Email.');
        return redirect()->back();
    }

    public function track($id_booking)
    {
        $bookingModel = new \App\Models\BookingModel();
        $data = [
            'b' => $bookingModel->select('tb_booking.*, tb_kamar.no_kamar')
                                ->join('tb_kamar', 'tb_kamar.id_kamar = tb_booking.id_kamar')
                                ->find($id_booking)
        ];
        return view('public/track_booking', $data);
    }

    public function payDP($id_booking)
    {
        $bookingModel = new \App\Models\BookingModel();
        $bookingModel->update($id_booking, ['status_booking' => 'Paid']);
        
        session()->setFlashdata('pesan_sukses', 'Pembayaran DP Berhasil! Admin akan segera memproses akun Anda.');
        return redirect()->to('/track/' . $id_booking);
    }
}