<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilPenghuniModel extends Model
{
    protected $table = 'tb_profil_penghuni';
    protected $primaryKey = 'id_profil_penghuni';
    protected $allowedFields = ['id_pengguna', 'id_kamar', 'nama_lengkap', 'no_wa', 'email', 'foto_ktp', 'kontak_darurat'];
    protected $useTimestamps = true;

    public function getPenghuniLengkap()
    {
        return $this->select('tb_profil_penghuni.*, tb_pengguna.username, tb_kamar.no_kamar, tb_tipe_kamar.nama_tipe')
                    ->join('tb_pengguna', 'tb_pengguna.id_pengguna = tb_profil_penghuni.id_pengguna')
                    ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar')
                    ->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')
                    ->findAll();
    }
}