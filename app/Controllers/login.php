<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        // Jika sudah login, langsung ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard_view'));
        }

        return view('login_view');
    }

    public function proses()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Username dan password yang sudah ditentukan
        $validUsername = 'bksmp3';
        $validPassword = 'admin123';

        if ($username === $validUsername && $password === $validPassword) {
            // Buat session login
            session()->set([
                'username'   => $username,
                'isLoggedIn' => true
            ]);

            return redirect()->to(base_url('dashboard_view'));
        } else {
            session()->setFlashdata('error', 'Login gagal! Username atau password salah.');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
