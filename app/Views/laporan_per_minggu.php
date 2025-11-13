<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pelanggaran | SPK Sanksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9;
        }
        .text-primary-app { color: #4f46e5 !important; }
        .header-laporan { border-bottom: 2px solid #e2e8f0; }
        .card-metric { transition: transform 0.3s ease-in-out; }
        .card-metric:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .table-row-danger { background-color: #fdebeb !important; }
        .table thead th { font-weight: 700; text-align: center; }
        .table td { font-size: 0.95rem; text-align: center; }
    </style>
</head>

<body>
<div class="container-fluid py-4 px-5">

    <!-- Header -->
    <div class="row header-laporan pb-3 mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="fs-3 fw-bold text-primary-app mb-1">LAPORAN PELANGGARAN SISWA</h1>
            <p class="text-secondary small">
                SMP NEGERI 3 BUKITTINGGI | Periode:
                <span class="fw-bold">
                    <?= $periode['tanggal_awal'] ?? '-' ?> s/d <?= $periode['tanggal_akhir'] ?? '-' ?>
                </span>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <form action="<?= base_url('laporan/cetakPdf') ?>" method="post" target="_blank">
                <input type="hidden" name="tanggal_awal" value="<?= esc($filter_tgl_awal ?? '') ?>">
                <input type="hidden" name="tanggal_akhir" value="<?= esc($filter_tgl_akhir ?? '') ?>">
                <button class="btn btn-dark">
                    <i class="bi bi-printer-fill me-2"></i> Cetak PDF
                </button>
            </form>
        </div>
    </div>

    <!-- Filter -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="<?= base_url('laporan/perMinggu') ?>" method="post" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control" value="<?= esc($filter_tgl_awal ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="<?= esc($filter_tgl_akhir ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary mt-3 w-100">
                        <i class="bi bi-search me-2"></i> Tampilkan Laporan
                    </button>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Cari Data Cepat:</label>
                    <input type="text" id="search_input" class="form-control" placeholder="Nama, Kelas, atau Sanksi...">
                </div>
            </form>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card card-metric shadow-sm border-start border-primary border-5 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-people-fill display-6 me-3 text-primary"></i>
                    <div>
                        <p class="text-muted mb-0 small fw-bold">Siswa Terlibat</p>
                        <h3 class="fw-bold mb-0"><?= $metrik['total_siswa_terlibat'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card card-metric shadow-sm border-start border-warning border-5 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill display-6 me-3 text-warning"></i>
                    <div>
                        <p class="text-muted mb-0 small fw-bold">Pelanggaran Terbanyak</p>
                        <h3 class="fw-bold mb-0"><?= esc($metrik['pelanggaran_terbanyak'] ?? 'Nihil') ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card card-metric shadow-sm border-start border-success border-5 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-clipboard-data-fill display-6 me-3 text-success"></i>
                    <div>
                        <p class="text-muted mb-0 small fw-bold">Total Kasus</p>
                        <h3 class="fw-bold mb-0"><?= $metrik['total_kasus'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card card-metric shadow-sm border-start border-info border-5 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-building display-6 me-3 text-info"></i>
                    <div>
                        <p class="text-muted mb-0 small fw-bold">Kelas Terbanyak</p>
                        <h3 class="fw-bold mb-0"><?= esc($metrik['kelas_terlibat_terbanyak'] ?? 'Nihil') ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-white fw-bold">Data Detail Pelanggaran</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-borderless align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>NO</th>
                            <th>NAMA SISWA</th>
                            <th>KELAS</th>
                            <th>TANGGAL</th>
                            <th class="text-start ps-3">JENIS PELANGGARAN</th>
                            <th>REKOMENDASI SANKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporan)): ?>
                            <?php $no = 1; foreach ($laporan as $row): 
                                $is_severe = (stripos($row['rekomendasi_sanksi'], 'dikeluarkan') !== false || stripos($row['rekomendasi_sanksi'], 'skorsing') !== false);
                                $row_class = $is_severe ? 'table-row-danger fw-bold text-danger' : '';
                            ?>
                                <tr class="<?= $row_class ?>">
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nama_siswa'] ?? '-') ?></td>
                                    <td><?= esc($row['kelas'] ?? '-') ?></td>
                                    <td><?= isset($row['tanggal']) ? date('d-m-Y', strtotime($row['tanggal'])) : '-' ?></td>
                                    <td class="text-start ps-3"><?= esc($row['jenis_pelanggaran'] ?? '-') ?></td>
                                    <td><?= esc($row['rekomendasi_sanksi'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada data pelanggaran untuk periode ini.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="row mt-4 mb-5">
        <div class="col-md-6">
            <p class="small fw-bold mb-1">Keterangan:</p>
            <div class="small text-muted border-start border-3 ps-2 border-secondary">
                Laporan ini merupakan hasil kompilasi data pelanggaran siswa dari sistem SPK berdasarkan periode yang dipilih.
            </div>
        </div>
        <div class="col-md-6 text-end">
            <p class="mb-5 mt-4">Guru BK</p>
            <p class="mt-5">( Bobi Tourist Yursa )</p>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('search_input').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    document.querySelectorAll('tbody tr').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>
</body>
</html>
