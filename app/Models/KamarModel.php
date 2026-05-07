<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
    protected $table = 'tb_kamar';
    protected $primaryKey = 'id_kamar';
    protected $allowedFields = ['id_tipe', 'no_kamar', 'status_kamar'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';

    public function getKamarWithTipe($id = false)
    {
        if ($id === false) {
            return $this->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')->findAll();
        }
        return $this->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')->where('id_kamar', $id)->first();
    }

    public function getKamarTersedia()
    {
        return $this->select('tb_kamar.*, tb_tipe_kamar.nama_tipe, tb_tipe_kamar.harga_dasar, tb_tipe_kamar.fasilitas')
                    ->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')
                    ->where('status_kamar', 'Tersedia')
                    ->findAll();
    }
}