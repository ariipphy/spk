<?php

namespace App\Controllers;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data['siswa'] = $this->siswaModel->findAll();
        return view('siswa/index', $data);
    }

    public function tambah()
    {
        return view('siswa/tambah');
    }

    public function simpan()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $rules = [
            'nis' => 'required|is_unique[siswa.nis]',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
        ];

        $messages = [
            'nis' => [
                'required' => 'NIS harus diisi.',
                'is_unique' => 'NIS sudah terdaftar.',
            ],
            'nama' => ['required' => 'Nama harus diisi.'],
            'kelas' => ['required' => 'Kelas harus diisi.'],
            'jenis_kelamin' => ['required' => 'Jenis kelamin harus dipilih.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data ke database
        $this->siswaModel->save([
            'nis' => $this->request->getPost('nis'),
            'nama' => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ]);

        return redirect()->to('/siswa')->with('success', 'Data siswa berhasil disimpan.');
    }

    public function edit($id)
    {
        $data['siswa'] = $this->siswaModel->find($id);
        if (!$data['siswa']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data siswa tidak ditemukan.');
        }

        return view('siswa/edit', $data);
    }

    public function update($id)
    {
        $existing = $this->siswaModel->find($id);
        if (!$existing) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data siswa tidak ditemukan.');
        }

        // Validasi NIS agar tetap unik, tapi mengizinkan NIS yang sama milik siswa ini
        $nisRule = ($this->request->getPost('nis') == $existing['nis']) ? 'required' : 'required|is_unique[siswa.nis]';

        $rules = [
            'nis' => $nisRule,
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->siswaModel->update($id, [
            'nis' => $this->request->getPost('nis'),
            'nama' => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ]);

        return redirect()->to('/siswa')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->siswaModel->delete($id);
        return redirect()->to('/siswa')->with('success', 'Data siswa berhasil dihapus.');
    }
}
