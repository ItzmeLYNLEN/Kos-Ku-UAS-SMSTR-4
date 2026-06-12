<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use App\Models\ProfilPenghuniModel;
use App\Models\KamarModel;

class AdminPenghuniController extends BaseController
{
    protected $penggunaModel;
    protected $profilModel;
    protected $kamarModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->profilModel = new ProfilPenghuniModel();
        $this->kamarModel = new KamarModel();
    }

    public function index()
    {
        $data = [
            'penghuni' => $this->profilModel->getPenghuniLengkap()
        ];
        return view('admin/penghuni/index', $data);
    }

    public function create()
    {
        $data = [
            'kamar_tersedia' => $this->kamarModel->where('status_kamar', 'Tersedia')->findAll()
        ];
        return view('admin/penghuni/create', $data);
    }

    public function delete($id)
    {
        $profil = $this->profilModel->find($id);
        
        $this->kamarModel->where('id_pengguna', $profil['id_pengguna'])
                         ->set(['status_kamar' => 'Tersedia', 'id_pengguna' => null])
                         ->update();

        $this->profilModel->delete($id);
        $this->penggunaModel->delete($profil['id_pengguna']);

        session()->setFlashdata('pesan', 'Data penghuni berhasil dihapus dan kamar dikosongkan.');
        return redirect()->to('/admin/penghuni');
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart(); 

        $no_wa = $this->request->getVar('no_wa');
        $id_kamar = $this->request->getVar('id_kamar');

        $penggunaLama = $this->penggunaModel->where('username', $no_wa)->first();

        if ($penggunaLama) {
            $id_pengguna = $penggunaLama['id_pengguna'];
            
        } else {
            $this->penggunaModel->insert([
                'username'       => $no_wa,
                'password'       => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'role'           => 'Penghuni',
                'is_first_login' => 1
            ]);

            $id_pengguna = $this->penggunaModel->getInsertID();

            $this->profilModel->insert([
                'id_pengguna'  => $id_pengguna,
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'no_wa'        => $no_wa
            ]);
        }

        $this->kamarModel->update($id_kamar, [
            'status_kamar' => 'Terisi',
            'id_pengguna'  => $id_pengguna
        ]);

        $db->transComplete(); 

        if ($db->transStatus() === false) {
            session()->setFlashdata('pesan_error', 'Gagal menyimpan data ke database.');
        } else {
            session()->setFlashdata('pesan', 'Kamar berhasil dialokasikan ke penghuni.');
        }

        return redirect()->to('/admin/penghuni');
    }
}