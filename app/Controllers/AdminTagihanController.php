<?php

namespace App\Controllers;

use App\Models\TagihanModel;
use App\Models\ProfilPenghuniModel;

class AdminTagihanController extends BaseController
{
    protected $tagihanModel;
    protected $profilModel;

    public function __construct()
    {
        $this->tagihanModel = new TagihanModel();
        $this->profilModel = new ProfilPenghuniModel();
    }

    public function index()
    {
        $data = [
            'tagihan' => $this->tagihanModel->getTagihanLengkap()
        ];
        return view('admin/tagihan/index', $data);
    }

    public function create()
    {
        $data = [
            'penghuni' => $this->profilModel->getPenghuniLengkap()
        ];
        return view('admin/tagihan/create', $data);
    }

    public function store()
    {
        $this->tagihanModel->save([
            'id_pengguna'   => $this->request->getVar('id_pengguna'),
            'bulan'         => $this->request->getVar('bulan'),
            'tahun'         => $this->request->getVar('tahun'),
            'nominal_asal'  => $this->request->getVar('nominal_asal'),
            'status_bayar'  => 'Belum Bayar'
        ]);

        session()->setFlashdata('pesan', 'Tagihan bulanan berhasil dibuat.');
        return redirect()->to('/admin/tagihan');
    }

    public function lunasi($id_tagihan)
    {
        $this->tagihanModel->update($id_tagihan, [
            'status_bayar' => 'Lunas'
        ]);

        session()->setFlashdata('pesan', 'Tagihan berhasil ditandai sebagai Lunas.');
        return redirect()->to('/admin/tagihan');
    }
}