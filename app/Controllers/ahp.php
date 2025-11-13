<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;

class Ahp extends BaseController
{
    public function index()
    {
        // Daftar kriteria sesuai urutan kode_kriteria: C1, C2, C3, C4
        $kriteria = [
            'Tingkat Pelanggaran',
            'Frekuensi',
            'Dampak',
            'Kesengajaan'
        ];

        // Matriks Perbandingan Kriteria (prioritas manual)
        $nilai = [
            [1,   3,  4,  5],
            [1/3, 1,  2,  3],
            [1/4, 1/2, 1,  2],
            [1/5, 1/3, 1/2, 1]
        ];

        // Hitung jumlah kolom
        $jml_kolom = [];
        for ($j = 0; $j < count($kriteria); $j++) {
            $jml = 0;
            for ($i = 0; $i < count($kriteria); $i++) {
                $jml += $nilai[$i][$j];
            }
            $jml_kolom[] = $jml;
        }

        // Normalisasi Matriks & Hitung Eigen Vector
        $normalisasi = [];
        $eigen = [];
        for ($i = 0; $i < count($kriteria); $i++) {
            $baris = [];
            for ($j = 0; $j < count($kriteria); $j++) {
                $val = $nilai[$i][$j] / $jml_kolom[$j];
                $baris[] = $val;
            }
            $normalisasi[] = $baris;
            $eigen[] = array_sum($baris) / count($kriteria);
        }

        // Hitung λmax
        $lambda_max = 0;
        for ($i = 0; $i < count($kriteria); $i++) {
            $total = 0;
            for ($j = 0; $j < count($kriteria); $j++) {
                $total += $nilai[$i][$j] * $eigen[$j];
            }
            $lambda_max += $total / $eigen[$i];
        }
        $lambda_max = $lambda_max / count($kriteria);

        // CI dan CR
        $CI = ($lambda_max - count($kriteria)) / (count($kriteria) - 1);
        $RI = [
            1 => 0.00,
            2 => 0.00,
            3 => 0.58,
            4 => 0.90,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32
        ];
        $CR = ($RI[count($kriteria)] != 0) ? $CI / $RI[count($kriteria)] : 0;

        // ================================
        // SIMPAN EIGEN VECTOR KE DATABASE
        // ================================
        $kriteriaModel = new KriteriaModel();

        // Ambil data kriteria dari database agar dapat kode_kriteria-nya
        $dataKriteria = $kriteriaModel->orderBy('id', 'asc')->findAll();
        // Simpan bobot ke masing-masing kriteria berdasarkan urutan
        foreach ($dataKriteria as $index => $k) {
            if (isset($eigen[$index])) {
                $kriteriaModel->update($k['id'], ['bobot' => $eigen[$index]]);
            }
        }

        // Tampilkan halaman
        return view('ahp_perhitungan', [
            'kriteria' => $kriteria,
            'nilai' => $nilai,
            'normalisasi' => $normalisasi,
            'eigen' => $eigen,
            'lambda_max' => $lambda_max,
            'ci' => $CI,
            'cr' => $CR
        ]);
        
    }
    
}
