<?php

namespace App\Controllers;

use App\Models\KamarModel;
use App\Models\BookingModel;
use Midtrans\Config;
use Midtrans\Snap;

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
        
        $booking = $bookingModel->select('tb_booking.*, tb_kamar.no_kamar, tb_tipe_kamar.harga_dasar, tb_tipe_kamar.nama_tipe')
                                ->join('tb_kamar', 'tb_kamar.id_kamar = tb_booking.id_kamar')
                                ->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')
                                ->find($id_booking);

        if (!$booking) {
            return redirect()->back();
        }

        $dp_amount = (int) round($booking['harga_dasar'] * 0.5);

        Config::$serverKey = getenv('MIDTRANS_SERVER_KEY'); 
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'DP-' . $booking['id_booking'] . '-' . time(), 
                'gross_amount' => $dp_amount,
            ],
            'customer_details' => [
                'first_name' => $booking['nama_calon'],
                'email'      => $booking['email'],
                'phone'      => $booking['no_wa'],
            ],
            'item_details' => [[
                'id'       => 'DP-KAMAR',
                'price'    => $dp_amount,
                'quantity' => 1,
                'name'     => 'DP 50% Kamar ' . $booking['no_kamar'] . ' (' . $booking['nama_tipe'] . ')'
            ]]
        ];

        $snapToken = Snap::getSnapToken($params);

        $data = [
            'b'         => $booking,
            'dp_amount' => $dp_amount,
            'snapToken' => $snapToken
        ];

        return view('public/pay_dp_midtrans', $data);
    }

   public function successDP($id_booking)
    {
        $db = \Config\Database::connect();
        
        $cekBooking = $db->table('tb_booking')->where('id_booking', $id_booking)->get()->getRowArray();
        
        if ($cekBooking) {
            $db->table('tb_booking')->where('id_booking', $id_booking)->update(['status_booking' => 'Paid']);
            session()->setFlashdata('pesan_sukses', 'Pembayaran DP Berhasil Diterima! Admin akan segera memproses akun Anda.');
        } else {
            session()->setFlashdata('pesan_error', 'Data booking tidak ditemukan.');
        }

        return redirect()->to('/track/' . $id_booking);
    }
}