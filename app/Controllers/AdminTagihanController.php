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

    public function bulkGenerate()
{
    $profilModel = new \App\Models\ProfilPenghuniModel();
    $penghuniAktif = $profilModel->select('tb_profil_penghuni.id_pengguna, tb_tipe_kamar.harga_dasar')
                                 ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar')
                                 ->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')
                                 ->findAll();

    $bulan = date('F'); // Contoh: May
    $tahun = date('Y');

    foreach ($penghuniAktif as $p) {
        // Cek dulu apakah sudah ada tagihan untuk bulan ini agar tidak double
        $exists = $this->tagihanModel->where([
            'id_pengguna' => $p['id_pengguna'],
            'bulan' => $bulan,
            'tahun' => $tahun
        ])->first();

        if (!$exists) {
            $this->tagihanModel->insert([
                'id_pengguna'  => $p['id_pengguna'],
                'bulan'        => $bulan,
                'tahun'        => $tahun,
                'nominal_asal' => $p['harga_dasar'],
                'status_bayar' => 'Belum Bayar'
            ]);
        }
    }

    session()->setFlashdata('pesan', 'Tagihan bulan ini untuk semua penghuni berhasil dibuat otomatis!');
    return redirect()->to('/admin/tagihan');
}
}