<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        
        $dataPengguna = [
            [
                'username'       => 'admin_utama', 
                'password'       => password_hash('admin123', PASSWORD_BCRYPT),
                'role'           => 'Admin',
                'is_first_login' => 0, 
            ],
            [
                'username'       => 'admin_penjaga', 
                'password'       => password_hash('penjaga123', PASSWORD_BCRYPT),
                'role'           => 'Admin',
                'is_first_login' => 0, 
            ],
            [
                'username'       => '0821', 
                'password'       => password_hash('awdawd', PASSWORD_BCRYPT), 
                'role'           => 'Penghuni',
                'is_first_login' => 1, 
            ]
        ];

        
        $this->db->table('tb_pengguna')->insertBatch($dataPengguna);

        
        $dataProfilAdmin = [
            [
                'id_pengguna'    => 1,
                'nama_lengkap'   => 'Bapak Kos',
                'no_wa'          => '080000000001',
            ],
            [
                'id_pengguna'    => 2,
                'nama_lengkap'   => 'Kang Ujang Penjaga',
                'no_wa'          => '080000000002',
            ]
        ];

        $this->db->table('tb_profil_admin')->insertBatch($dataProfilAdmin);

        
        $dataProfilPenghuni = [
            [
                'id_pengguna'    => 3, 
                'nama_lengkap'   => 'Awaludin',
                'no_wa'          => '0821',
                'email'          => 'udin@gmail.com',
                'foto_ktp'       => null, 
                'kontak_darurat' => null,
            ]
        ];

        $this->db->table('tb_profil_penghuni')->insertBatch($dataProfilPenghuni);
    }
}