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
        return $this->select('tb_tagihan.*, tb_profil_penghuni.nama_lengkap, GROUP_CONCAT(tb_kamar.no_kamar SEPARATOR ", ") as no_kamar')
                    ->join('tb_profil_penghuni', 'tb_profil_penghuni.id_pengguna = tb_tagihan.id_pengguna')
                    ->join('tb_kamar', 'tb_kamar.id_pengguna = tb_profil_penghuni.id_pengguna', 'left')
                    ->groupBy('tb_tagihan.id_tagihan')
                    ->orderBy('tb_tagihan.tahun', 'DESC')
                    ->orderBy('tb_tagihan.bulan', 'DESC')
                    ->findAll();
    }
}