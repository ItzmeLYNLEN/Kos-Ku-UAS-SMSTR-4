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
            'tagihan' => $this->tagihanModel->where('id_pengguna', $id_pengguna)
                                            ->orderBy('tahun', 'DESC')
                                            ->orderBy('bulan', 'DESC')
                                            ->findAll()
        ];
        
        return view('penghuni/tagihan/index', $data);
    }
}