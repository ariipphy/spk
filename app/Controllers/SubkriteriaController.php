<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubkriteriaModel;
use App\Models\KriteriaModel;

class SubKriteriaController extends BaseController
{
    protected $KriteriaModel;
    protected $SubKriteriaModel;

    public function __construct()
    {
       $this->KriteriaModel = new KriteriaModel();          // ✅ sesuai deklarasi properti
    $this->SubKriteriaModel = new SubkriteriaModel();
    }

    public function index()
  
    {
        $kriteria = $this->KriteriaModel->findAll();
        $subkriteria = $this->SubKriteriaModel->findAll();

        // ✅ REVISI: Kelompokkan berdasarkan id_kriteria, bukan id
        $groupedSubkriteria = [];
        foreach ($subkriteria as $sub) {
            $groupedSubkriteria[$sub['id_kriteria']][] = $sub;
        }

        return view('subkriteria/index', [
            'kriteria' => $kriteria,
            'groupedSubkriteria' => $groupedSubkriteria
        ]);
    
}


    public function tambah($id_kriteria)
{
    $kriteriaModel = new \App\Models\KriteriaModel();
    $kriteria = $kriteriaModel->find($id_kriteria);

    if (!$kriteria) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kriteria tidak ditemukan");
    }

    return view('subkriteria/tambah', [
        'title' => 'Tambah Sub Kriteria',
        'kriteria' => $kriteria
    ]);
}


   public function simpan()
{
    $data = [
        'id_kriteria' => $this->request->getPost('id_kriteria'),
        'nama_subkriteria' => $this->request->getPost('nama_subkriteria'),
        'nilai' => $this->request->getPost('nilai'),
    ];

    $this->SubKriteriaModel->insert($data);

    return redirect()->to('/subkriteria')->with('success', 'Sub kriteria berhasil ditambahkan.');
}



    public function edit($id)
    {
        $model = new SubkriteriaModel();
        $kriteriaModel = new KriteriaModel();

        $data = [
            'title' => 'Edit Sub Kriteria',
            'subkriteria' => $model->find($id),
            'kriteria' => $kriteriaModel->findAll(),
        ];
        return view('subkriteria/edit', $data);
    }

    public function update($id)
    {
        $model = new SubkriteriaModel();
        $data = [
            'id_kriteria' => $this->request->getPost('id_kriteria'),
            'nama_subkriteria' => $this->request->getPost('nama_subkriteria'),
            'nilai' => $this->request->getPost('nilai'),
        ];
        $model->update($id, $data);
        return redirect()->to('/subkriteria')->with('success', 'Subkriteria berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new SubkriteriaModel();
        $model->delete($id);
        return redirect()->to('/subkriteria')->with('success', 'Subkriteria berhasil dihapus.');
    }
}
