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
        $this->kamarModel->save([
            'id_tipe'      => $this->request->getVar('id_tipe'),
            'no_kamar'     => $this->request->getVar('no_kamar'),
            'status_kamar' => $this->request->getVar('status_kamar')
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
        $this->kamarModel->save([
            'id_kamar'     => $id,
            'id_tipe'      => $this->request->getVar('id_tipe'),
            'no_kamar'     => $this->request->getVar('no_kamar'),
            'status_kamar' => $this->request->getVar('status_kamar')
        ]);
        session()->setFlashdata('pesan', 'Data kamar berhasil diubah.');
        return redirect()->to('/admin/kamar');
    }

    public function delete($id)
    {
        $this->kamarModel->delete($id);
        session()->setFlashdata('pesan', 'Data kamar berhasil dihapus.');
        return redirect()->to('/admin/kamar');
    }
}