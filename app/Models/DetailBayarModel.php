<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailBayarModel extends Model
{
    protected $table = 'tb_detail_bayar';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = ['id_bayar', 'id_tagihan'];
    protected $useTimestamps = false;
}