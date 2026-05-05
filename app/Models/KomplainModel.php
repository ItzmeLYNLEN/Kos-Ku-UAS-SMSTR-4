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
}