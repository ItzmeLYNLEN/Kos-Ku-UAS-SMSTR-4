<?php

namespace App\Controllers;

use App\Models\TipeKamarModel;

class TipeKamarController extends BaseController
{
    protected $tipeKamarModel;

    public function __construct()
    {
        $this->tipeKamarModel = new TipeKamarModel();
    }

    public function index()
    {
        $data = [
            'tipe_kamar' => $this->tipeKamarModel->findAll()
        ];
        return view('admin/tipe_kamar/index', $data);
    }

    public function create()
    {
        return view('admin/tipe_kamar/create');
    }

    public function store()
    {
        $this->tipeKamarModel->save([
            'nama_tipe'   => $this->request->getVar('nama_tipe'),
            'harga_dasar' => $this->request->getVar('harga_dasar'),
            'fasilitas'   => $this->request->getVar('fasilitas'),
        ]);
        session()->setFlashdata('pesan', 'Data tipe kamar berhasil ditambahkan.');
        return redirect()->to('/admin/tipe-kamar');
    }

    public function edit($id)
    {
        $data = [
            'tipe' => $this->tipeKamarModel->find($id)
        ];
        return view('admin/tipe_kamar/edit', $data);
    }

    public function update($id)
    {
        $this->tipeKamarModel->save([
            'id_tipe'     => $id,
            'nama_tipe'   => $this->request->getVar('nama_tipe'),
            'harga_dasar' => $this->request->getVar('harga_dasar'),
            'fasilitas'   => $this->request->getVar('fasilitas'),
        ]);
        session()->setFlashdata('pesan', 'Data tipe kamar berhasil diubah.');
        return redirect()->to('/admin/tipe-kamar');
    }

    public function delete($id)
    {
        $this->tipeKamarModel->delete($id);
        session()->setFlashdata('pesan', 'Data tipe kamar berhasil dihapus.');
        return redirect()->to('/admin/tipe-kamar');
    }
}