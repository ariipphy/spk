<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi Pelanggaran Siswa</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 40px;
        }
        /* === KOP SURAT === */
        .header-kop {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }
        .logo-cell {
            display: table-cell;
            width: 100px;
            vertical-align: middle;
            padding-right: 15px;
        }
        .logo-cell img {
            width: 85px;
            height: 85px;
            object-fit: contain;
            display: block;
        }
        .header-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .header-text h3 {
            margin: 0;
            padding: 0;
            font-size: 13pt;
            font-weight: bold;
            line-height: 1.2;
        }
        .header-text p {
            margin: 3px 0 0 0;
            font-size: 9pt;
            line-height: 1.3;
        }
        /* === GARIS PEMBATAS === */
        .hr-container {
            margin: 5px 0 10px 0;
        }
        hr.thick {
            border: none;
            border-top: 3px solid #000;
            margin: 0 0 1px 0;
        }
        hr.thin {
            border: none;
            border-top: 1px solid #000;
            margin: 0;
        }
        /* === JUDUL === */
        h4 {
            text-align: center;
            margin: 10px 0 8px 0;
            font-size: 12pt;
            font-weight: bold;
            text-decoration: underline;
        }
        .periode {
            margin: 5px 0 8px 0;
            font-size: 11pt;
        }
        /* === TABEL === */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 4px;
            text-align: center;
            font-size: 10pt;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td {
            vertical-align: middle;
        }
        /* Lebar kolom */
        th:nth-child(1), td:nth-child(1) { width: 5%; }
        th:nth-child(2), td:nth-child(2) { width: 20%; }
        th:nth-child(3), td:nth-child(3) { width: 8%; }
        th:nth-child(4), td:nth-child(4) { width: 12%; }
        th:nth-child(5), td:nth-child(5) { width: 25%; }
        th:nth-child(6), td:nth-child(6) { width: 30%; }
        
        /* === TANDA TANGAN === */
        .signature {
            margin-top: 40px;
            text-align: right;
        }
        .signature p {
            margin: 2px 0;
            font-size: 11pt;
        }
        .signature .space {
            margin-top: 50px;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="header-kop">
        <div class="logo-cell">
            <?php 
                $pathLogo = FCPATH . 'img/logo_sekolah.png';
                $logoBase64 = '';
                if (file_exists($pathLogo)) {
                    $logoData = base64_encode(file_get_contents($pathLogo));
                    $logoBase64 = 'data:image/png;base64,' . $logoData;
                }
            ?>
            <?php if ($logoBase64): ?>
                <img src="<?= $logoBase64 ?>" alt="Logo Sekolah">
            <?php else: ?>
                <div style="width:85px;height:85px;border:1px solid #ccc;line-height:85px;text-align:center;font-size:9pt;">Logo</div>
            <?php endif; ?>
        </div>
        <div class="header-text">
            <h3>PEMERINTAH KOTA BUKITTINGGI</h3>
            <h3>SMP NEGERI 3 BUKITTINGGI</h3>
            <p>Jl. Jambu No. 3, Bukit Apit Puhun, Kec. Guguk Panjang, Kota Bukittinggi, Sumatera Barat<br>
            Telp. 0752-34278 | Email: smpnegeri3bukittinggi@gmail.com</p>
        </div>
    </div>
    
    <div class="hr-container">
        <hr class="thick">
        <hr class="thin">
    </div>
    
    <h4>LAPORAN REKAPITULASI PELANGGARAN SISWA</h4>
    
    <p class="periode">Periode: <?= esc($periode['tanggal_awal']) ?> s/d <?= esc($periode['tanggal_akhir']) ?></p>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Jenis Pelanggaran</th>
                <th>Rekomendasi Sanksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($laporan as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($row['nama_siswa']) ?></td>
                <td><?= esc($row['kelas']) ?></td>
                <td><?= esc($row['tanggal']) ?></td>
                <td><?= esc($row['jenis_pelanggaran']) ?></td>
                <td><?= esc($row['rekomendasi_sanksi']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="signature">
        <p>Bukittinggi, <?= date('d-m-Y') ?></p>
        <p>Guru BK</p>
        <p class="space"><strong><u>Bobi Tourist Yarsa, S.Pd.</u></strong></p>
    </div>
</body>
</html>