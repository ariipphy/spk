<?php

namespace App\Controllers;
use App\Models\PelanggaranModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $pelanggaranModel = new PelanggaranModel();

        // Hitung jumlah sanksi dari tabel pelanggaran
        $jumlah_sanksi = $pelanggaranModel
            ->select('rekomendasi_sanksi, COUNT(*) as total')
            ->groupBy('rekomendasi_sanksi')
            ->findAll();

        // Ambil data untuk pie chart (perbandingan tiap sanksi)
        $total_per_sanksi = [];
        foreach ($jumlah_sanksi as $row) {
            $total_per_sanksi[] = [
                'metode' => $row['rekomendasi_sanksi'],
                'total' => $row['total']
            ];
        }

        $data = [
            'jumlah_sanksi' => $jumlah_sanksi,
            'perbandingan_metode' => $total_per_sanksi
        ];

        return view('dashboard_view', $data);
    }
}
