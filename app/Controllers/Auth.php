<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function process()
    {
        $session = session();
        $model = new PenggunaModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $data = $model->where('username', $username)->first();
        
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            
            if ($verify_pass) {
                $ses_data = [
                    'id_pengguna'    => $data['id_pengguna'],
                    'username'       => $data['username'],
                    'role'           => $data['role'],
                    'is_first_login' => $data['is_first_login'],
                    'logged_in'      => TRUE
                ];
                $session->set($ses_data);
                
                if ($data['is_first_login'] == 1) {
                    return redirect()->to('/ganti-password');
                }
                
                if ($data['role'] == 'Admin') {
                    return redirect()->to('/admin/dashboard');
                } else {
                    return redirect()->to('/penghuni/dashboard');
                }
            } else {
                $session->setFlashdata('msg', 'Password salah.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username tidak ditemukan.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function gantiPassword()
    {
        return view('auth/ganti_password');
    }

    public function processGantiPassword()
    {
        $session = session();
        $model = new \App\Models\PenggunaModel();
        
        $id_pengguna = $session->get('id_pengguna');
        $password_baru = $this->request->getVar('password_baru');
        
        $data = [
            'password'       => password_hash($password_baru, PASSWORD_BCRYPT),
            'is_first_login' => 0
        ];
        
        $model->update($id_pengguna, $data);
        
        $session->set('is_first_login', 0);
        
        return redirect()->to('/penghuni/dashboard');
    }
}