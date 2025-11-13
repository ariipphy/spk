<!-- app/Views/laporan_hasil.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <!-- Header -->
    <div class="text-center mb-4">
        <img src="<?= base_url('img/logo_sekolah.png') ?>" alt="Logo Sekolah" width="80" class="mb-2">
        <h4 class="fw-bold">SMPN 3 Bukittinggi</h4>
        <h5 class="text-muted">Sistem Pendukung Keputusan Penetapan Sanksi</h5>
        <hr>
    </div>

    <!-- Judul -->
    <div class="text-center mb-5">
        <h3 class="fw-bold">📑 Laporan Hasil</h3>
        <p class="text-muted">Silakan pilih jenis laporan yang ingin Anda lihat</p>
    </div>

    <!-- Menu pilihan laporan -->
    <div class="row justify-content-center g-4">
        <!-- Laporan Mingguan -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-3 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Laporan Mingguan</h5>
                    <p class="card-text text-muted">Rekapitulasi pelanggaran siswa selama 7 hari terakhir.</p>
                    <a href="<?= base_url('topsis/laporanMingguan') ?>" class="btn btn-primary">
                        📅 Lihat Laporan Mingguan
                    </a>
                </div>
            </div>
        </div>

        <!-- Laporan Per Siswa -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-3 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Laporan Per Siswa</h5>
                    <p class="card-text text-muted">Detail riwayat pelanggaran per siswa beserta rekomendasi sanksi.</p>
                    <a href="<?= base_url('topsis/pilihSiswa') ?>" class="btn btn-success">
                        👤 Pilih Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol kembali -->
    <div class="text-center mt-5">
        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">⬅️ Kembali ke Dashboard</a>
    </div>
</div>

</body>
</html>
