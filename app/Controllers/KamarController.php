<?php

namespace App\Controllers;

use App\Models\KamarModel;
use App\Models\TipeKamarModel;

class KamarController extends BaseController
{
    protected $kamarModel;
    protected $tipeKamarModel;

    public function __construct()
    {
        $this->kamarModel = new KamarModel();
        $this->tipeKamarModel = new TipeKamarModel();
    }

    public function index()
    {
        $data = [
            'kamar' => $this->kamarModel->getKamarWithTipe()
        ];
        return view('admin/kamar/index', $data);
    }

    public function create()
    {
        $data = [
            'tipe_kamar' => $this->tipeKamarModel->findAll()
        ];
        return view('admin/kamar/create', $data);
    }

    public function store()
    {
        $noKamar = $this->request->getPost('no_kamar');
        
        $cekKamar = $this->kamarModel->where('no_kamar', $noKamar)->first();
        if ($cekKamar) {
            session()->setFlashdata('pesan_error', 'Gagal! Nomor Kamar ' . $noKamar . ' sudah terdaftar.');
            return redirect()->back()->withInput();
        }

        $this->kamarModel->insert([
            'id_tipe'      => $this->request->getPost('id_tipe'),
            'no_kamar'     => $noKamar,
            'status_kamar' => $this->request->getPost('status_kamar')
        ]);
        
        session()->setFlashdata('pesan', 'Data kamar berhasil ditambahkan.');
        return redirect()->to('/admin/kamar');
    }

    public function edit($id)
    {
        $data = [
            'kamar'      => $this->kamarModel->find($id),
            'tipe_kamar' => $this->tipeKamarModel->findAll()
        ];
        return view('admin/kamar/edit', $data);
    }

    public function update($id)
    {
        $noKamarBaru = $this->request->getPost('no_kamar');
        $kamarLama = $this->kamarModel->find($id);

        if ($noKamarBaru !== $kamarLama['no_kamar']) {
            $cekKamar = $this->kamarModel->where('no_kamar', $noKamarBaru)->first();
            if ($cekKamar) {
                session()->setFlashdata('pesan_error', 'Gagal! Nomor Kamar ' . $noKamarBaru . ' sudah digunakan.');
                return redirect()->back()->withInput();
            }
        }

        $this->kamarModel->update($id, [
            'id_tipe'      => $this->request->getPost('id_tipe'),
            'no_kamar'     => $noKamarBaru,
            'status_kamar' => $this->request->getPost('status_kamar')
        ]);
        
        session()->setFlashdata('pesan', 'Data kamar berhasil diubah.');
        return redirect()->to('/admin/kamar');
    }

    public function delete($id)
    {
        $profilPenghuniModel = new \App\Models\ProfilPenghuniModel();
        $adaPenghuni = $profilPenghuniModel->where('id_kamar', $id)->first();
        
        if ($adaPenghuni) {
            session()->setFlashdata('pesan_error', 'Gagal menghapus! Kamar ini sedang diisi oleh penghuni.');
            return redirect()->to('/admin/kamar');
        }

        $this->kamarModel->delete($id);
        session()->setFlashdata('pesan', 'Data kamar berhasil dihapus.');
        return redirect()->to('/admin/kamar');
    }
}