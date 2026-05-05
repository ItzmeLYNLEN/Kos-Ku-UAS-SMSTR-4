<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table = 'tb_tagihan';
    protected $primaryKey = 'id_tagihan';
    protected $allowedFields = ['id_pengguna', 'bulan', 'tahun', 'nominal_asal', 'nominal_denda', 'status_bayar'];
    protected $useTimestamps = true;

    public function getTagihanLengkap()
    {
        return $this->select('tb_tagihan.*, tb_profil_penghuni.nama_lengkap, tb_kamar.no_kamar')
                    ->join('tb_profil_penghuni', 'tb_profil_penghuni.id_pengguna = tb_tagihan.id_pengguna')
                    ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar')
                    ->orderBy('tb_tagihan.tahun', 'DESC')
                    ->orderBy('tb_tagihan.bulan', 'DESC')
                    ->findAll();
    }
}