<?php

namespace App\Models;

use CodeIgniter\Model;

class TipeKamarModel extends Model
{
    protected $table = 'tb_tipe_kamar';
    protected $primaryKey = 'id_tipe';
    protected $allowedFields = ['nama_tipe', 'harga_dasar', 'fasilitas'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';
}