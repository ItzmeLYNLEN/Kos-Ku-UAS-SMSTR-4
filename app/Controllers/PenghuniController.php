<?php

namespace App\Controllers;

class PenghuniController extends BaseController
{
    public function index()
    {
        return view('penghuni/dashboard');
    }
}