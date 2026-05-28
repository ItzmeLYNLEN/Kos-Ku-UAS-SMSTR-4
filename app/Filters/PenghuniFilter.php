<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\ProfilPenghuniModel;

class PenghuniFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'Penghuni') {
            return redirect()->to('/login');
        }

        $profilModel = new ProfilPenghuniModel();
        $profil = $profilModel->where('id_pengguna', session()->get('id_pengguna'))->first();
        
        $uri = service('uri');
        $currentSegment = $uri->getSegment(1);

        if (empty($profil['foto_ktp']) && $currentSegment != 'onboarding') {
            return redirect()->to('/onboarding');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}