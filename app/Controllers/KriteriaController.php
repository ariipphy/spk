<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use CodeIgniter\Controller;

class KriteriaController extends BaseController
{
    // Deklarasi model agar bisa dipakai di semua fungsi
    protected $kriteriaModel;

    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
    }

    // Tampilkan semua data kriteria
    public function index()
    {
        $data = [
            'title' => 'Data Kriteria',
            'kriteria' => $this->kriteriaModel->findAll()
        ];

        return view('kriteria/index', $data);
    }

    // Form tambah kriteria
    public function tambah()
    {
        $data['title'] = 'Tambah Kriteria';
        return view('kriteria/tambah', $data);
    }

    // Simpan data kriteria baru
    public function simpan()
    {
        $data = [
            'kode_kriteria' => $this->request->getPost('kode_kriteria'),
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
        ];

        $this->kriteriaModel->insert($data);
        return redirect()->to('/kriteria')->with('success', 'Data berhasil ditambahkan.');
    }

    // Form edit data kriteria
    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Kriteria',
            'kriteria' => $this->kriteriaModel->find($id)
        ];

        return view('kriteria/edit', $data);
    }

    // Update data kriteria
    public function update($id)
    {
        // Cek apakah kode_kriteria sudah ada (duplikat)
        $existing = $this->kriteriaModel
            ->where('kode_kriteria', $this->request->getPost('kode_kriteria'))
            ->where('id !=', $id)
            ->first();

        if ($existing) {
            return redirect()->back()->withInput()->with('error', 'Kode kriteria sudah digunakan.');
        }

        $data = [
            'kode_kriteria' => $this->request->getPost('kode_kriteria'),
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
        ];

        $this->kriteriaModel->update($id, $data);
        return redirect()->to('/kriteria')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data kriteria
    public function delete($id)
    {
        $kriteria = $this->kriteriaModel->find($id);

        if (!$kriteria) {
            return redirect()->to('/kriteria')->with('error', 'Kriteria tidak ditemukan.');
        }

        $this->kriteriaModel->delete($id);
        return redirect()->to('/kriteria')->with('success', 'Data berhasil dihapus.');
    }
}
