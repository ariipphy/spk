<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pelanggaran Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12pt; }
        .kop { text-align: center; border-bottom: 3px double #000; margin-bottom: 20px; }
        .kop img { width: 70px; position: absolute; left: 50px; top: 20px; }
        h2, h3 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: center; }
        .ttd { margin-top: 40px; width: 100%; }
        .ttd td { text-align: center; }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="kop">
        <div class="logo">
            <img 
                src="<?= base_url('img/logo sekolah.jpeg') ?>" 
                alt="Logo Sekolah"
                onerror="this.onerror=null;this.src='https://placehold.co/90x90/EEEEEE/333333?text=Logo';"
            >
        </div>
        <h2>PEMERINTAH KOTA BUKITTINGGI</h2>
        <h3>SMPN 3 BUKITTINGGI</h3>
        <p>Jl. Contoh Alamat No.123, Bukittinggi - Sumatera Barat</p>
    </div>

    <h3 style="text-align:center; text-decoration: underline;">LAPORAN PELANGGARAN SISWA</h3>
    <br>

    <p><b>NIS:</b> <?= $siswa['nis'] ?><br>
       <b>Nama:</b> <?= $siswa['nama'] ?></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggaran</th>
                <th>Rekomendasi Sanksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pelanggaran)): ?>
                <tr>
                    <td colspan="4">Tidak ada data pelanggaran</td>
                </tr>
            <?php else: ?>
                <?php foreach ($pelanggaran as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['nama_pelanggaran'] ?></td>
                    <td><?= $row['rekomendasi_sanksi'] ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <br><br>
    <table class="ttd">
        <tr>
            <td></td>
            <td>Bukittinggi, <?= date('d-m-Y') ?><br>
                Kepala Sekolah<br><br><br><br>
                <b>(___________________)</b>
            </td>
        </tr>
    </table>

</body>
</html>
