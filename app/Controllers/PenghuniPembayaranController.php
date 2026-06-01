<?php

namespace App\Controllers;

use App\Models\TagihanModel;
use App\Models\PembayaranModel;
use App\Models\DetailBayarModel;

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
        $id_tagihan = $this->request->getVar('id_tagihan');
        $metode_bayar = $this->request->getVar('metode_bayar');

        if (!$id_tagihan) {
            session()->setFlashdata('pesan_error', 'Pilih minimal satu tagihan untuk dibayar.');
            return redirect()->to('/penghuni/pembayaran');
        }

        $total = 0;
        foreach ($id_tagihan as $id) {
            $tagihan = $this->tagihanModel->find($id);
            $total += ($tagihan['nominal_asal'] + $tagihan['nominal_denda']);
        }

        $kode_transaksi = 'INV-' . time() . '-' . session()->get('id_pengguna');

        $this->pembayaranModel->insert([
            'kode_transaksi'   => $kode_transaksi,
            'total_bayar'      => $total,
            'metode_bayar'     => $metode_bayar,
            'status_transaksi' => 'Pending',
            'waktu_expired'    => date('Y-m-d H:i:s', strtotime('+1 day'))
        ]);

        $id_bayar = $this->pembayaranModel->getInsertID();

        foreach ($id_tagihan as $id) {
            $this->detailBayarModel->insert([
                'id_bayar'   => $id_bayar,
                'id_tagihan' => $id
            ]);
        }

        return redirect()->to('/penghuni/pembayaran/invoice/' . $kode_transaksi);
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