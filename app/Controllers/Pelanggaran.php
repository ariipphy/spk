<?php

namespace App\Controllers;

use App\Models\PelanggaranModel;
use App\Models\SiswaModel;
use App\Models\SubkriteriaModel;
use CodeIgniter\Controller;

class Pelanggaran extends Controller
{
    protected $pelanggaranModel;
    protected $siswaModel;
    protected $subkriteriaModel;

    public function __construct()
    {
        $this->pelanggaranModel = new PelanggaranModel();
        $this->siswaModel = new SiswaModel();
        $this->subkriteriaModel = new SubkriteriaModel();
    }

    // Tampilkan daftar pelanggaran
    public function index()
    {
        $data['pelanggaran'] = $this->pelanggaranModel->getFullData();
        return view('pelanggaran_daftar', $data);
    }

    // Tampilkan form tambah pelanggaran
    public function tambah()
    {
        $siswaModel = new SiswaModel();
    $subkriteriaModel = new SubkriteriaModel();

    $data = [
        'siswa' => $siswaModel->findAll(),
        'subkriteria' => $subkriteriaModel->findAll() // ambil semua subkriteria
    ];

        $data = [
            'siswa' => $this->siswaModel->findAll(),
            'tingkat' => $this->subkriteriaModel->where('id_kriteria', 1)->findAll(),
            'frekuensi' => $this->subkriteriaModel->where('id_kriteria', 2)->findAll(),
            'dampak' => $this->subkriteriaModel->where('id_kriteria', 3)->findAll(),
            'kesengajaan' => $this->subkriteriaModel->where('id_kriteria', 4)->findAll()
        ];

        return view('pelanggaran_input', $data);
    }

    // Simpan data pelanggaran baru
    public function simpan()
{
    $validation = \Config\Services::validation();

    $rules = [
        'id_siswa' => 'required',
        'nama_pelanggaran' => 'required',
        'tanggal' => 'required',
        'id_subkriteria_tingkat' => 'required',
        'id_subkriteria_frekuensi' => 'required',
        'id_subkriteria_dampak' => 'required',
        'id_subkriteria_kesengajaan' => 'required'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $this->pelanggaranModel->save([
        'id_siswa' => $this->request->getPost('id_siswa'),
        'nama_pelanggaran' => $this->request->getPost('nama_pelanggaran'),
        'tanggal' => $this->request->getPost('tanggal'),
        'id_subkriteria_tingkat' => $this->request->getPost('id_subkriteria_tingkat'),
        'id_subkriteria_frekuensi' => $this->request->getPost('id_subkriteria_frekuensi'),
        'id_subkriteria_dampak' => $this->request->getPost('id_subkriteria_dampak'),
        'id_subkriteria_kesengajaan' => $this->request->getPost('id_subkriteria_kesengajaan')
    ]);

    return redirect()->to('/pelanggaran')->with('success', 'Data pelanggaran berhasil ditambahkan.');
}


    // Tampilkan form edit
    public function edit($id)
    {
        $pelanggaran = $this->pelanggaranModel->find($id);
        if (!$pelanggaran) {
            return redirect()->to('/pelanggaran')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'pelanggaran' => $pelanggaran,
            'siswa' => $this->siswaModel->findAll(),
            'tingkat' => $this->subkriteriaModel->where('id_kriteria', 1)->findAll(),
            'frekuensi' => $this->subkriteriaModel->where('id_kriteria', 2)->findAll(),
            'dampak' => $this->subkriteriaModel->where('id_kriteria', 3)->findAll(),
            'kesengajaan' => $this->subkriteriaModel->where('id_kriteria', 4)->findAll()
        ];

        return view('pelanggaran_edit', $data);
    }

    // Proses update
    public function update($id)
    {
        $this->pelanggaranModel->update($id, [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'nama_pelanggaran' => $this->request->getPost('nama_pelanggaran'),
            'tanggal' => $this->request->getPost('tanggal'),
            'id_subkriteria_tingkat' => $this->request->getPost('id_subkriteria_tingkat'),
            'id_subkriteria_frekuensi' => $this->request->getPost('id_subkriteria_frekuensi'),
            'id_subkriteria_dampak' => $this->request->getPost('id_subkriteria_dampak'),
            'id_subkriteria_kesengajaan' => $this->request->getPost('id_subkriteria_kesengajaan')
        ]);

        return redirect()->to('/pelanggaran')->with('success', 'Data pelanggaran berhasil diubah.');
    }

    // Hapus data
    public function hapus($id)
    {
        $this->pelanggaranModel->delete($id);
        return redirect()->to('/pelanggaran')->with('success', 'Data pelanggaran berhasil dihapus.');
    }
}
