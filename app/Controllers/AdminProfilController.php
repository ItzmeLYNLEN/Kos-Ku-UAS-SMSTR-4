<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class AdminProfilController extends BaseController
{
    protected $penggunaModel;
    protected $db;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $id_pengguna = session()->get('id_pengguna');
        
        $data['admin'] = $this->penggunaModel->select('tb_pengguna.*, tb_profil_admin.nama_lengkap, tb_profil_admin.no_wa')
                                             ->join('tb_profil_admin', 'tb_profil_admin.id_pengguna = tb_pengguna.id_pengguna', 'left')
                                             ->where('tb_pengguna.id_pengguna', $id_pengguna)
                                             ->first();
        
        return view('admin/profil/index', $data);
    }

    public function update()
    {
        $id_pengguna = session()->get('id_pengguna');
        $username_baru = $this->request->getPost('username');
        
        $dataPengguna = [
            'username'       => $username_baru,
            'is_first_login' => 0
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $dataPengguna['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->penggunaModel->builder()->where('id_pengguna', $id_pengguna)->update($dataPengguna);

        $dataProfil = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_wa'        => $this->request->getPost('no_wa')
        ];

        $cekProfil = $this->db->table('tb_profil_admin')->where('id_pengguna', $id_pengguna)->get()->getRow();
        if ($cekProfil) {
            $this->db->table('tb_profil_admin')->where('id_pengguna', $id_pengguna)->update($dataProfil);
        } else {
            $dataProfil['id_pengguna'] = $id_pengguna;
            $this->db->table('tb_profil_admin')->insert($dataProfil);
        }
        
        session()->set('username', $username_baru);
        session()->setFlashdata('pesan', 'Profil Admin berhasil diperbarui!');
        return redirect()->back();
    }

    public function listAdmin()
    {
        $data['admins'] = $this->penggunaModel->select('tb_pengguna.*, tb_profil_admin.nama_lengkap, tb_profil_admin.no_wa')
                                              ->join('tb_profil_admin', 'tb_profil_admin.id_pengguna = tb_pengguna.id_pengguna', 'left')
                                              ->where('tb_pengguna.role', 'Admin')
                                              ->findAll();
        return view('admin/kelola_admin/index', $data);
    }

    public function create()
    {
        return view('admin/kelola_admin/create');
    }

    public function store()
    {
        $dataBaru = [
            'username'       => $this->request->getPost('username'),
            'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'           => 'Admin',
            'is_first_login' => 0
        ];

        $cekUsername = $this->penggunaModel->where('username', $dataBaru['username'])->first();
        if ($cekUsername) {
            session()->setFlashdata('pesan_error', 'Username sudah digunakan, silakan pilih yang lain.');
            return redirect()->back()->withInput();
        }

        $this->penggunaModel->insert($dataBaru);
        $id_pengguna_baru = $this->penggunaModel->insertID();

        $dataProfil = [
            'id_pengguna'  => $id_pengguna_baru,
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_wa'        => $this->request->getPost('no_wa')
        ];
        $this->db->table('tb_profil_admin')->insert($dataProfil);
        
        session()->setFlashdata('pesan', 'Admin baru berhasil ditambahkan!');
        return redirect()->to('/admin/kelola-admin');
    }

    public function delete($id)
    {
        if ($id == session()->get('id_pengguna')) {
            session()->setFlashdata('pesan_error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang login.');
            return redirect()->back();
        }

        $this->db->table('tb_profil_admin')->where('id_pengguna', $id)->delete();
        $this->penggunaModel->delete($id);
        
        session()->setFlashdata('pesan', 'Akun Admin berhasil dihapus.');
        return redirect()->back();
    }
}