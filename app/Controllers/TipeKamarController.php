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
        $data = [
            'nama_tipe'   => $this->request->getVar('nama_tipe'),
            'harga_dasar' => $this->request->getVar('harga_dasar'),
            'fasilitas'   => $this->request->getVar('fasilitas'),
            'deskripsi'   => $this->request->getVar('deskripsi')
        ];

        for ($i = 1; $i <= 3; $i++) {
            $fileFoto = $this->request->getFile('foto_' . $i);
            if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
                $namaFoto = $fileFoto->getRandomName();
                $fileFoto->move(ROOTPATH . 'public/uploads/kamar', $namaFoto);
                $data['foto_' . $i] = $namaFoto;
            }
        }

        $this->tipeKamarModel->save($data);
        session()->setFlashdata('pesan', 'Data tipe kamar beserta foto berhasil ditambahkan.');
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
        $tipeLama = $this->tipeKamarModel->find($id);

        $data = [
            'id_tipe'     => $id,
            'nama_tipe'   => $this->request->getVar('nama_tipe'),
            'harga_dasar' => $this->request->getVar('harga_dasar'),
            'fasilitas'   => $this->request->getVar('fasilitas'),
            'deskripsi'   => $this->request->getVar('deskripsi')
        ];

        for ($i = 1; $i <= 3; $i++) {
            $fileFoto = $this->request->getFile('foto_' . $i);
            
            if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
                $namaFoto = $fileFoto->getRandomName();
                $fileFoto->move(ROOTPATH . 'public/uploads/kamar', $namaFoto);
                $data['foto_' . $i] = $namaFoto;
                
                if (!empty($tipeLama['foto_' . $i]) && file_exists(ROOTPATH . 'public/uploads/kamar/' . $tipeLama['foto_' . $i])) {
                    unlink(ROOTPATH . 'public/uploads/kamar/' . $tipeLama['foto_' . $i]);
                }
            }
        }

        $this->tipeKamarModel->save($data);
        session()->setFlashdata('pesan', 'Data tipe kamar berhasil diubah.');
        return redirect()->to('/admin/tipe-kamar');
    }

    public function delete($id)
    {
        $tipe = $this->tipeKamarModel->find($id);

        if ($tipe) {
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($tipe['foto_' . $i]) && file_exists(ROOTPATH . 'public/uploads/kamar/' . $tipe['foto_' . $i])) {
                    unlink(ROOTPATH . 'public/uploads/kamar/' . $tipe['foto_' . $i]);
                }
            }
            $this->tipeKamarModel->delete($id);
            session()->setFlashdata('pesan', 'Data tipe kamar berhasil dihapus.');
        }

        return redirect()->to('/admin/tipe-kamar');
    }
}