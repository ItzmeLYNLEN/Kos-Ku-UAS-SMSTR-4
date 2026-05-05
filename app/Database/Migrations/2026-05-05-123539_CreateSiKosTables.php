<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiKosTables extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'id_pengguna'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'       => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'password'       => ['type' => 'VARCHAR', 'constraint' => '255'],
            'role'           => ['type' => 'ENUM', 'constraint' => ['Admin', 'Penghuni']],
            'is_first_login' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_pengguna', true);
        $this->forge->createTable('tb_pengguna');

        
        $this->forge->addField([
            'id_tipe'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_tipe'   => ['type' => 'VARCHAR', 'constraint' => '50'],
            'harga_dasar' => ['type' => 'INT', 'constraint' => 11],
            'fasilitas'   => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_tipe', true);
        $this->forge->createTable('tb_tipe_kamar');

        
        $this->forge->addField([
            'id_bayar'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode_transaksi'   => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'total_bayar'      => ['type' => 'INT', 'constraint' => 11],
            'metode_bayar'     => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'waktu_expired'    => ['type' => 'DATETIME', 'null' => true],
            'status_transaksi' => ['type' => 'ENUM', 'constraint' => ['Pending', 'Success', 'Expired'], 'default' => 'Pending'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_bayar', true);
        $this->forge->createTable('tb_pembayaran');

       
        $this->forge->addField([
            'id_profil_admin' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pengguna'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_lengkap'    => ['type' => 'VARCHAR', 'constraint' => '100'],
            'no_wa'           => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_profil_admin', true);
        $this->forge->addForeignKey('id_pengguna', 'tb_pengguna', 'id_pengguna', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_profil_admin');

        
        $this->forge->addField([
            'id_profil_penghuni' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pengguna'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_lengkap'       => ['type' => 'VARCHAR', 'constraint' => '100'],
            'no_wa'              => ['type' => 'VARCHAR', 'constraint' => '20'],
            'email'              => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'foto_ktp'           => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'kontak_darurat'     => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_profil_penghuni', true);
        $this->forge->addForeignKey('id_pengguna', 'tb_pengguna', 'id_pengguna', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_profil_penghuni');

        
        $this->forge->addField([
            'id_kamar'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_tipe'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'no_kamar'     => ['type' => 'VARCHAR', 'constraint' => '10'],
            'status_kamar' => ['type' => 'ENUM', 'constraint' => ['Tersedia', 'Terisi', 'Perbaikan'], 'default' => 'Tersedia'],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_kamar', true);
        $this->forge->addForeignKey('id_tipe', 'tb_tipe_kamar', 'id_tipe', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_kamar');

        
        $this->forge->addField([
            'id_booking'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_kamar'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_calon'     => ['type' => 'VARCHAR', 'constraint' => '100'],
            'no_wa'          => ['type' => 'VARCHAR', 'constraint' => '20'],
            'email'          => ['type' => 'VARCHAR', 'constraint' => '100'],
            'nominal_dp'     => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'waktu_batas_dp' => ['type' => 'DATETIME', 'null' => true],
            'status_booking' => ['type' => 'ENUM', 'constraint' => ['Menunggu Persetujuan', 'Menunggu DP', 'Paid', 'Ditolak'], 'default' => 'Menunggu Persetujuan'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_booking', true);
        $this->forge->addForeignKey('id_kamar', 'tb_kamar', 'id_kamar', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_booking');

        
        $this->forge->addField([
            'id_tagihan'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pengguna'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'bulan'         => ['type' => 'VARCHAR', 'constraint' => '20'],
            'tahun'         => ['type' => 'YEAR', 'constraint' => 4],
            'nominal_asal'  => ['type' => 'INT', 'constraint' => 11],
            'nominal_denda' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'status_bayar'  => ['type' => 'ENUM', 'constraint' => ['Belum Bayar', 'Lunas', 'Dibatalkan'], 'default' => 'Belum Bayar'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_tagihan', true);
        $this->forge->addForeignKey('id_pengguna', 'tb_pengguna', 'id_pengguna', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_tagihan');

        
        $this->forge->addField([
            'id_detail'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_bayar'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_tagihan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addKey('id_detail', true);
        $this->forge->addForeignKey('id_bayar', 'tb_pembayaran', 'id_bayar', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_tagihan', 'tb_tagihan', 'id_tagihan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_detail_bayar');

        
        $this->forge->addField([
            'id_komplain'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pengguna'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'deskripsi'        => ['type' => 'TEXT'],
            'foto_bukti'       => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'status_perbaikan' => ['type' => 'ENUM', 'constraint' => ['Pending', 'Proses', 'Selesai'], 'default' => 'Pending'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_komplain', true);
        $this->forge->addForeignKey('id_pengguna', 'tb_pengguna', 'id_pengguna', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_komplain');
    }

    public function down()
    {
        
        $this->db->disableForeignKeyChecks();

       
        $this->forge->dropTable('tb_komplain');
        $this->forge->dropTable('tb_detail_bayar');
        $this->forge->dropTable('tb_tagihan');
        $this->forge->dropTable('tb_booking');
        $this->forge->dropTable('tb_kamar');
        $this->forge->dropTable('tb_profil_penghuni');
        $this->forge->dropTable('tb_profil_admin');
        $this->forge->dropTable('tb_pembayaran');
        $this->forge->dropTable('tb_tipe_kamar');
        $this->forge->dropTable('tb_pengguna');

       
        $this->db->enableForeignKeyChecks();
    }
}