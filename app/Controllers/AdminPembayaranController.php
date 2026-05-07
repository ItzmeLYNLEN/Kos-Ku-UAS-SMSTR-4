<?php

namespace App\Controllers;

use App\Models\PembayaranModel;

class AdminPembayaranController extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {
        $data = [
            'pembayaran' => $this->pembayaranModel->getPembayaranLengkap()
        ];
        
        return view('admin/pembayaran/index', $data);
    }
}