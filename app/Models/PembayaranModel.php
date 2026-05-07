<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'tb_pembayaran';
    protected $primaryKey = 'id_bayar';
    protected $allowedFields = ['kode_transaksi', 'total_bayar', 'metode_bayar', 'waktu_expired', 'status_transaksi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';

    public function getPembayaranLengkap()
    {
        $builder = $this->db->table('tb_pembayaran');
        $builder->select('tb_pembayaran.*, tb_profil_penghuni.nama_lengkap, GROUP_CONCAT(CONCAT(tb_tagihan.bulan, " ", tb_tagihan.tahun) SEPARATOR ", ") as bulan_dibayar');
        $builder->join('tb_detail_bayar', 'tb_detail_bayar.id_bayar = tb_pembayaran.id_bayar');
        $builder->join('tb_tagihan', 'tb_tagihan.id_tagihan = tb_detail_bayar.id_tagihan');
        $builder->join('tb_profil_penghuni', 'tb_profil_penghuni.id_pengguna = tb_tagihan.id_pengguna');
        $builder->groupBy('tb_pembayaran.id_bayar');
        $builder->orderBy('tb_pembayaran.created_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }
}