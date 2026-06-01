<?php

namespace App\Controllers;

use App\Models\TagihanModel;

class PenghuniTagihanController extends BaseController
{
    protected $tagihanModel;

    public function __construct()
    {
        $this->tagihanModel = new TagihanModel();
    }

    public function index()
    {
        $id_pengguna = session()->get('id_pengguna');
        
        $data = [
            'tagihan' => $this->tagihanModel->select('tb_tagihan.*, tb_pembayaran.metode_bayar')
                                            ->join('tb_detail_bayar', 'tb_detail_bayar.id_tagihan = tb_tagihan.id_tagihan', 'left')
                                            ->join('tb_pembayaran', 'tb_pembayaran.id_bayar = tb_detail_bayar.id_bayar', 'left')
                                            ->where('tb_tagihan.id_pengguna', $id_pengguna)
                                            ->orderBy('tb_tagihan.tahun', 'DESC')
                                            ->orderBy('tb_tagihan.bulan', 'DESC')
                                            ->findAll()
        ];
        
        return view('penghuni/tagihan/index', $data);
    }
}