<?php

namespace App\Controllers;

use App\Models\TagihanModel;
use App\Models\PembayaranModel;
use App\Models\DetailBayarModel;
use Midtrans\Config;
use Midtrans\Snap;

class PenghuniPembayaranController extends BaseController
{
    protected $tagihanModel;
    protected $pembayaranModel;
    protected $detailBayarModel;

    public function __construct()
    {
        $this->tagihanModel = new TagihanModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->detailBayarModel = new DetailBayarModel();
    }

    public function index()
    {
        $data = [
            'tagihan' => $this->tagihanModel->where('id_pengguna', session()->get('id_pengguna'))
                                            ->where('status_bayar', 'Belum Bayar')
                                            ->orderBy('tahun', 'ASC')
                                            ->orderBy('bulan', 'ASC')
                                            ->findAll()
        ];
        
        return view('penghuni/pembayaran/index', $data);
    }

    public function checkout()
    {
        $id_tagihan = $this->request->getPost('id_tagihan');
        
        $tagihanModel = new \App\Models\TagihanModel();
        $tagihan = $tagihanModel->find($id_tagihan);

        if (!$tagihan) {
            return redirect()->back();
        }

        $total_bayar = (int) round($tagihan['nominal_asal'] + $tagihan['nominal_denda']);
        $kode_transaksi = 'INV-' . $id_tagihan . '-' . time();

        $pembayaranModel = new \App\Models\PembayaranModel();
        $pembayaranModel->insert([
            'kode_transaksi'   => $kode_transaksi,
            'total_bayar'      => $total_bayar,
            'metode_bayar'     => 'Midtrans',
            'status_transaksi' => 'Pending'
        ]);
        $id_bayar = $pembayaranModel->getInsertID();

        $detailBayarModel = new \App\Models\DetailBayarModel();
        $detailBayarModel->insert([
            'id_bayar'   => $id_bayar,
            'id_tagihan' => $id_tagihan
        ]);

        Config::$serverKey = getenv('MIDTRANS_SERVER_KEY'); 
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $kode_transaksi, 
                'gross_amount' => $total_bayar,
            ],
            'customer_details' => [
                'first_name' => session()->get('username'), 
            ],
            'item_details' => [[
                'id'       => 'TAGIHAN-' . $tagihan['bulan'] . '-' . $tagihan['tahun'],
                'price'    => $total_bayar,
                'quantity' => 1,
                'name'     => 'Tagihan Kos Bulan ' . $tagihan['bulan'] . ' ' . $tagihan['tahun']
            ]]
        ];

        $snapToken = Snap::getSnapToken($params);

        $data = [
            'tagihan'     => $tagihan,
            'snapToken'   => $snapToken,
            'total_bayar' => $total_bayar
        ];

        return view('penghuni/pembayaran/pay_midtrans', $data);
    }

    public function successPay($id_tagihan)
    {
        $db = \Config\Database::connect();
        
        $cekTagihan = $db->table('tb_tagihan')->where('id_tagihan', $id_tagihan)->get()->getRowArray();
        
        if ($cekTagihan) {
            $db->table('tb_tagihan')->where('id_tagihan', $id_tagihan)->update(['status_bayar' => 'Lunas']);
            
            $detail = $db->table('tb_detail_bayar')
                         ->where('id_tagihan', $id_tagihan)
                         ->orderBy('id_detail', 'DESC')
                         ->get()
                         ->getRowArray();
                         
            if ($detail) {
                $db->table('tb_pembayaran')
                   ->where('id_bayar', $detail['id_bayar'])
                   ->update(['status_transaksi' => 'Success']);
            }

            session()->setFlashdata('pesan', 'Pembayaran tagihan berhasil dan sudah lunas!');
        }

        return redirect()->to('/penghuni/tagihan');
    }

    public function invoice($param)
    {
        $pembayaran = $this->pembayaranModel->where('kode_transaksi', $param)->first();

        if ($pembayaran) {
            $semua_detail = $this->detailBayarModel->select('tb_tagihan.*')
                                         ->join('tb_tagihan', 'tb_tagihan.id_tagihan = tb_detail_bayar.id_tagihan')
                                         ->where('id_bayar', $pembayaran['id_bayar'])
                                         ->findAll();
        } else {
            $detail = $this->detailBayarModel->where('id_tagihan', $param)->first();

            if (!$detail) {
                session()->setFlashdata('pesan_error', 'Kwitansi fisik tidak tersedia karena tagihan ini dilunasi secara manual oleh Admin.');
                return redirect()->back();
            }

            $pembayaran = $this->pembayaranModel->find($detail['id_bayar']);
            $semua_detail = $this->detailBayarModel->select('tb_tagihan.*')
                                         ->join('tb_tagihan', 'tb_tagihan.id_tagihan = tb_detail_bayar.id_tagihan')
                                         ->where('id_bayar', $pembayaran['id_bayar'])
                                         ->findAll();
        }

        $profilModel = new \App\Models\ProfilPenghuniModel();
        $p = $profilModel->select('tb_profil_penghuni.*, tb_kamar.no_kamar')
                         ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar', 'left')
                         ->where('tb_profil_penghuni.id_pengguna', session()->get('id_pengguna'))
                         ->first();

        $data = [
            'pembayaran' => $pembayaran,
            'detail'     => $semua_detail,
            'p'          => $p 
        ];

        return view('penghuni/pembayaran/invoice', $data);
    }

    public function simulatePay($kode_transaksi)
    {
        $pembayaran = $this->pembayaranModel->where('kode_transaksi', $kode_transaksi)->first();
        
        $this->pembayaranModel->update($pembayaran['id_bayar'], [
            'status_transaksi' => 'Success'
        ]);
        
        $detail = $this->detailBayarModel->where('id_bayar', $pembayaran['id_bayar'])->findAll();
        foreach ($detail as $d) {
            $this->tagihanModel->update($d['id_tagihan'], [
                'status_bayar' => 'Lunas'
            ]);
        }

        session()->setFlashdata('pesan', 'Pembayaran berhasil disimulasikan dan tagihan lunas!');
        return redirect()->to('/penghuni/tagihan');
    }
}