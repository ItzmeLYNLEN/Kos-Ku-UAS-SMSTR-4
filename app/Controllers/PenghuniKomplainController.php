<?php

namespace App\Controllers;

use App\Models\KomplainModel;

class PenghuniKomplainController extends BaseController
{
    protected $komplainModel;

    public function __construct()
    {
        $this->komplainModel = new KomplainModel();
    }

    public function index()
    {
        $data = [
            'komplain' => $this->komplainModel->where('id_pengguna', session()->get('id_pengguna'))
                                              ->orderBy('created_at', 'DESC')
                                              ->findAll()
        ];
        
        return view('penghuni/komplain/index', $data);
    }

    public function create()
    {
        return view('penghuni/komplain/create');
    }

    public function store()
    {
        $fileFoto = $this->request->getFile('foto_bukti');
        $namaFoto = null;

        if ($fileFoto && $fileFoto->isValid() && ! $fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('uploads/komplain', $namaFoto);
        }

        $this->komplainModel->save([
            'id_pengguna'      => session()->get('id_pengguna'),
            'deskripsi'        => $this->request->getVar('deskripsi'),
            'foto_bukti'       => $namaFoto,
            'status_perbaikan' => 'Pending'
        ]);

        session()->setFlashdata('pesan', 'Laporan komplain berhasil dikirim.');
        return redirect()->to('/penghuni/komplain');
    }
}