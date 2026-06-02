<?php

namespace App\Controllers;

use App\Models\TagihanModel;
use App\Models\ProfilPenghuniModel;

class AdminTagihanController extends BaseController
{
    protected $tagihanModel;
    protected $profilModel;

    public function __construct()
    {
        $this->tagihanModel = new TagihanModel();
        $this->profilModel = new ProfilPenghuniModel();
    }

    public function index()
    {
        $data = [
            'tagihan' => $this->tagihanModel->getTagihanLengkap()
        ];
        return view('admin/tagihan/index', $data);
    }

    public function create()
    {
        $data = [
            'penghuni' => $this->profilModel->getPenghuniLengkap()
        ];
        return view('admin/tagihan/create', $data);
    }

    public function store()
    {
        $this->tagihanModel->save([
            'id_pengguna'   => $this->request->getVar('id_pengguna'),
            'bulan'         => $this->request->getVar('bulan'),
            'tahun'         => $this->request->getVar('tahun'),
            'nominal_asal'  => $this->request->getVar('nominal_asal'),
            'status_bayar'  => 'Belum Bayar'
        ]);

        session()->setFlashdata('pesan', 'Tagihan bulanan berhasil dibuat.');
        return redirect()->to('/admin/tagihan');
    }

    public function lunasi($id_tagihan)
    {
        $this->tagihanModel->update($id_tagihan, [
            'status_bayar' => 'Lunas'
        ]);

        session()->setFlashdata('pesan', 'Tagihan berhasil ditandai sebagai Lunas.');
        return redirect()->to('/admin/tagihan');
    }

    public function bulkGenerate()
    {
        $profilModel = new \App\Models\ProfilPenghuniModel();
        
        $penghuniAktif = $profilModel->select('tb_profil_penghuni.id_pengguna, tb_tipe_kamar.harga_dasar')
                                     ->join('tb_kamar', 'tb_kamar.id_kamar = tb_profil_penghuni.id_kamar')
                                     ->join('tb_tipe_kamar', 'tb_tipe_kamar.id_tipe = tb_kamar.id_tipe')
                                     ->findAll();

        $bulanIndo = [
            'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
            'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
            'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
            'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
        ];
        
        $bulan = $bulanIndo[date('F')]; 
        $tahun = date('Y');
        $jumlahDibuat = 0;

        foreach ($penghuniAktif as $p) {
            $exists = $this->tagihanModel->where([
                'id_pengguna' => $p['id_pengguna'],
                'bulan'       => $bulan,
                'tahun'       => $tahun
            ])->first();

            if (!$exists) {
                $this->tagihanModel->insert([
                    'id_pengguna'   => $p['id_pengguna'],
                    'bulan'         => $bulan,
                    'tahun'         => $tahun,
                    'nominal_asal'  => $p['harga_dasar'],
                    'nominal_denda' => 0,
                    'status_bayar'  => 'Belum Bayar'
                ]);
                $jumlahDibuat++;
            }
        }

        if ($jumlahDibuat > 0) {
            session()->setFlashdata('pesan', "$jumlahDibuat tagihan bulan $bulan $tahun berhasil dibuat otomatis!");
        } else {
            session()->setFlashdata('pesan_error', "Semua penghuni sudah punya tagihan untuk bulan $bulan $tahun.");
        }

        return redirect()->to('/admin/tagihan');
    }

    public function hapus($id_tagihan)
    {
        $tagihanModel = new \App\Models\TagihanModel();
        
        $tagihan = $tagihanModel->find($id_tagihan);
        
        if ($tagihan && $tagihan['status_bayar'] == 'Belum Bayar') {
            $tagihanModel->delete($id_tagihan);
            session()->setFlashdata('pesan', 'Tagihan berhasil dihapus.');
        } else {
            session()->setFlashdata('pesan_error', 'Gagal menghapus! Tagihan mungkin sudah lunas atau tidak ditemukan.');
        }

        return redirect()->back();
    }

}