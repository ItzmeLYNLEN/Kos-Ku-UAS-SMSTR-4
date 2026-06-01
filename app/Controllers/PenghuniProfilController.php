<?php

namespace App\Controllers;

use App\Models\ProfilPenghuniModel;
use App\Models\PenggunaModel;

class PenghuniProfilController extends BaseController
{
    protected $profilModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->profilModel = new ProfilPenghuniModel();
        $this->penggunaModel = new PenggunaModel();
    }

    public function index()
    {
        $id_pengguna = session()->get('id_pengguna');
        
        $profil = $this->profilModel->select('tb_profil_penghuni.*, tb_kamar.no_kamar, tb_tipe_kamar.nama_tipe')
                                    ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar', 'left')
                                    ->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe', 'left')
                                    ->where('tb_profil_penghuni.id_pengguna', $id_pengguna)
                                    ->first();

        $pengguna = $this->penggunaModel->find($id_pengguna);

        $data = [
            'profil'   => $profil,
            'pengguna' => $pengguna
        ];

        return view('penghuni/profil/index', $data);
    }

    public function update()
    {
        $id_pengguna = session()->get('id_pengguna');
        $profil = $this->profilModel->where('id_pengguna', $id_pengguna)->first();

        $no_wa_baru = $this->request->getPost('no_hp');

        $dataUpdateProfil = [
            'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
            'no_wa'          => $no_wa_baru,
            'email'          => $this->request->getPost('email'),
            'kontak_darurat' => $this->request->getPost('kontak_darurat')
        ];

        $fileKtp = $this->request->getFile('foto_ktp');
        if ($fileKtp && $fileKtp->isValid() && !$fileKtp->hasMoved()) {
            $namaKtp = $fileKtp->getRandomName();
            $fileKtp->move(ROOTPATH . 'public/uploads/ktp', $namaKtp);
            $dataUpdateProfil['foto_ktp'] = $namaKtp;

            if ($profil && !empty($profil['foto_ktp']) && file_exists(ROOTPATH . 'public/uploads/ktp/' . $profil['foto_ktp'])) {
                unlink(ROOTPATH . 'public/uploads/ktp/' . $profil['foto_ktp']);
            }
        }

        $this->profilModel->builder()->where('id_pengguna', $id_pengguna)->update($dataUpdateProfil);

        $dataPengguna = [
            'username'       => $no_wa_baru,
            'is_first_login' => 0
        ];
        
        $password = $this->request->getPost('password');
        if(!empty($password)){
            $dataPengguna['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        
        $this->penggunaModel->builder()->where('id_pengguna', $id_pengguna)->update($dataPengguna);

        session()->set('username', $no_wa_baru);

        session()->setFlashdata('pesan', 'Profil berhasil diperbarui!');
        return redirect()->back();
    }
}