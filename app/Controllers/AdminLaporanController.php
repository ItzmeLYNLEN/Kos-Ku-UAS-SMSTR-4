<?php

namespace App\Controllers;

use App\Models\TagihanModel;

class AdminLaporanController extends BaseController
{
    public function index()
    {
        $tagihanModel = new TagihanModel();
        
        $bulanIndo = [
            'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
            'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
            'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
            'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
        ];

        $bulanDefault = $bulanIndo[date('F')];
        $bulan = $this->request->getGet('bulan') ?? $bulanDefault;
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'laporan' => $tagihanModel->select('tb_tagihan.*, tb_profil_penghuni.nama_lengkap, tb_kamar.no_kamar')
                                      ->join('tb_profil_penghuni', 'tb_profil_penghuni.id_pengguna = tb_tagihan.id_pengguna')
                                      ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar')
                                      ->where('tb_tagihan.status_bayar', 'Lunas') 
                                      ->where('tb_tagihan.bulan', $bulan)
                                      ->where('tb_tagihan.tahun', $tahun)
                                      ->findAll(),
            'filter_bulan' => $bulan,
            'filter_tahun' => $tahun,
            'list_bulan'   => array_values($bulanIndo)
        ];

        return view('admin/laporan/index', $data);
    }

    public function exportExcel()
    {
        $tagihanModel = new TagihanModel();
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        $data = $tagihanModel->select('tb_tagihan.*, tb_profil_penghuni.nama_lengkap, tb_kamar.no_kamar')
                             ->join('tb_profil_penghuni', 'tb_profil_penghuni.id_pengguna = tb_tagihan.id_pengguna')
                             ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar')
                             ->where('tb_tagihan.status_bayar', 'Lunas') 
                             ->where('tb_tagihan.bulan', $bulan)
                             ->where('tb_tagihan.tahun', $tahun)
                             ->findAll();

        $filename = "Laporan_Pembayaran_{$bulan}_{$tahun}.xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        echo "Laporan Pembayaran Si-Kos\n";
        echo "Bulan: $bulan $tahun\n\n";
        echo "No\tNama Penghuni\tNo Kamar\tBulan Tagihan\tTanggal Bayar\tNominal\n";

        $no = 1;
        foreach ($data as $d) {
            $total_bayar = $d['nominal_asal'] + $d['nominal_denda']; 
            echo $no++ . "\t";
            echo $d['nama_lengkap'] . "\t";
            echo $d['no_kamar'] . "\t";
            echo $d['bulan'] . " " . $d['tahun'] . "\t";
            echo date('d/m/Y', strtotime($d['updated_at'])) . "\t"; 
            echo "Rp " . number_format($total_bayar, 0, ',', '.') . "\n";
        }
        exit();
    }
}