<?php

namespace App\Controllers;

use App\Models\KomplainModel;

class AdminKomplainController extends BaseController
{
    protected $komplainModel;

    public function __construct()
    {
        $this->komplainModel = new KomplainModel();
    }

    public function index()
    {
        $data = [
            'komplain' => $this->komplainModel->getKomplainLengkap()
        ];
        return view('admin/komplain/index', $data);
    }

    public function updateStatus($id_komplain)
    {
        $this->komplainModel->update($id_komplain, [
            'status_perbaikan' => $this->request->getVar('status_perbaikan')
        ]);

        session()->setFlashdata('pesan', 'Status perbaikan berhasil diperbarui.');
        return redirect()->to('/admin/komplain');
    }
}