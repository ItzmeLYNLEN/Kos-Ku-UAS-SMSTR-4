<?php

namespace App\Models;

use CodeIgniter\Model;

class KomplainModel extends Model
{
    protected $table = 'tb_komplain';
    protected $primaryKey = 'id_komplain';
    protected $allowedFields = ['id_pengguna', 'deskripsi', 'foto_bukti', 'status_perbaikan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';

    public function getKomplainLengkap()
    {
        return $this->select('tb_komplain.*, tb_profil_penghuni.nama_lengkap, tb_kamar.no_kamar')
                    ->join('tb_profil_penghuni', 'tb_profil_penghuni.id_pengguna = tb_komplain.id_pengguna')
                    ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar')
                    ->orderBy('tb_komplain.created_at', 'DESC')
                    ->findAll();
    }
}