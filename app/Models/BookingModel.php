<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'tb_booking';
    protected $primaryKey = 'id_booking';
    protected $allowedFields = ['id_kamar', 'nama_calon', 'no_wa', 'email', 'status_booking', 'nominal_dp'];
}