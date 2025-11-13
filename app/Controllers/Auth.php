<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        // tampilkan halaman login
        return view('login_view');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // login default
        if ($username === 'bksmp3' && $password === 'admin123') {
            // buat session login
            session()->set('isLoggedIn', true);
            session()->set('username', $username);

            // arahkan ke dashboard
            return redirect()->to(base_url('dashboard'));
        } else {
            // jika salah
            return redirect()->to(base_url('/'))
                             ->with('error_message', 'Username atau password salah!');
        }
    }

    public function logout()
{
    // Hapus semua data session
    session()->destroy();

    // Arahkan kembali ke halaman login
    return redirect()->to(base_url('/'))->with('error_message', "Anda telah logout dari sistem.");
}
}
