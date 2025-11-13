<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SPK Sanksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        /* Skema Warna Baru: Charcoal (#2c3e50) dan Mint (#2ecc71) */
        :root {
            --color-dark: #2c3e50; /* Charcoal */
            --color-dark-alt: #34495e; /* Darker Blue-Gray */
            --color-mint: #2ecc71; /* Mint/Emerald Accent */
            --color-mint-dark: #16a085; /* Darker Mint */
            --color-background: #f4f7fa;
            --color-text: #ecf0f1;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--color-background);
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar {
            /* Warna Dasar: Charcoal */
            background: linear-gradient(90deg, var(--color-dark), var(--color-dark-alt)); 
            padding: 0 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--color-text);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 64px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            overflow: hidden; 
        }
        
        .navbar marquee {
            width: 100%;
            white-space: nowrap;
        }

        .navbar strong {
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff;
            padding: 1rem 0; 
            display: block; 
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px; 
            height: 100vh;
            /* Warna Sidebar: Dark Blue-Gray */
            background-color: var(--color-dark-alt); 
            color: white;
            position: fixed;
            top: 64px;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 3px 0 10px rgba(0,0,0,0.15);
            transition: width 0.3s;
        }

        .sidebar-menu {
            flex-grow: 1;
            overflow-y: auto;
            padding-top: 1.5rem;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            border-left: 5px solid transparent; 
            font-size: 15px;
            font-weight: 500;
        }
        
        /* Item menu yang sedang aktif (Dashboard) */
        .sidebar li:first-child { 
            background-color: rgba(255, 255, 255, 0.1); 
            border-left: 5px solid var(--color-mint); /* Highlight Mint */
            font-weight: 600;
        }

        .sidebar li:hover {
            /* Warna Hover: Mint */
            background-color: var(--color-mint); 
            border-left: 5px solid var(--color-mint-dark);
            color: var(--color-dark); /* Teks gelap saat hover di latar mint */
        }
        
        /* Ikon saat hover */
        .sidebar li:hover i {
            color: var(--color-dark);
        }

        .sidebar li i {
            margin-right: 12px;
            font-size: 20px;
            color: #ecf0f1; /* Warna ikon default */
            transition: color 0.3s;
        }

        /* LOGOUT */
        .logout-section {
            padding: 1rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            background: var(--color-dark); 
            position: sticky;
            bottom: 0;
        }

        .logout-section a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            background: #e74c3c; /* Merah untuk Logout */
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s, transform 0.2s;
        }

        .logout-section a:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        /* MAIN AREA */
        .main {
            margin-left: 270px; 
            padding: 2rem;
            margin-top: 84px; 
            min-height: calc(100vh - 84px);
            transition: all 0.3s ease;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-dark); /* Judul menggunakan warna gelap */
            margin-bottom: 2rem;
            text-align: center;
            line-height: 1.4;
            padding: 0 1rem;
        }

        /* INFO BOX */
        .info-row {
            display: flex;
            gap: 1.5rem; 
            justify-content: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .info-box {
            background: #ffffff;
            padding: 1.2rem 2rem; 
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            font-weight: 700; 
            color: var(--color-mint-dark); /* Teks menggunakan aksen Mint gelap */
            font-size: 1.1rem;
            min-width: 250px;
            text-align: center;
            border-left: 5px solid var(--color-mint); /* Garis aksen mint */
            transition: box-shadow 0.3s;
        }

        .info-box:hover {
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        /* CARDS */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem; 
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 1rem;
            padding: 1.8rem; 
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.3s;
            text-align: center;
        }

        .card h4 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 1rem;
        }

        .card:hover {
            transform: translateY(-8px); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        canvas {
            width: 100% !important;
            height: 300px !important;
            display: block;
            margin: 0 auto;
        }

        /* MEDIA QUERY UNTUK LAYAR MOBILE */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                top: 64px;
                position: relative;
                box-shadow: none;
                z-index: 999;
            }
            .sidebar-menu {
                padding-top: 0;
            }
            .sidebar ul {
                display: flex;
                overflow-x: auto;
                white-space: nowrap;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }
            .sidebar li {
                padding: 12px 20px;
                border-left: none;
                border-radius: 0;
                margin-right: 0;
                justify-content: center;
            }
            .sidebar li span {
                display: none;
            }
            .main {
                margin-left: 0;
                margin-top: 0; 
            }
            .info-box {
                min-width: 45%;
                font-size: 1rem;
                padding: 1rem;
                border-left: none; /* Hapus garis aksen di mobile */
            }
            .cards {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .logout-section {
                display: none; 
            }
            .navbar strong {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <div class="navbar">
        <!-- Teks Berjalan menggunakan MARQUEE -->
        <marquee behavior="scroll" direction="left" scrollamount="6">
            <strong>SELAMAT DATANG DI SISTEM PENDUKUNG KEPUTUSAN PENETAPAN SANKSI</strong>
        </marquee>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-menu">
            <ul>
                <li><i class="ph ph-gauge"></i> <span>Dashboard</span></li> 
                <li onclick="location.href='<?= base_url('siswa') ?>'"><i class="ph ph-users"></i> <span>Data Siswa</span></li>
                <li onclick="location.href='<?= base_url('kriteria') ?>'"><i class="ph ph-list"></i> <span>Data Kriteria</span></li>
                <li onclick="location.href='<?= base_url('subkriteria') ?>'"><i class="ph ph-list-plus"></i> <span>Sub Kriteria</span></li>
                <!-- ICON BARU DITAMBAHKAN DI SINI -->
                               <li onclick="location.href='<?= base_url('pelanggaran') ?>'"><i class="ph ph-warning"></i> <span>Input Pelanggaran</span></li>
                <li onclick="location.href='<?= base_url('ahp') ?>'"><i class="ph ph-flow-chart"></i> <span>Proses AHP</span></li> 
                <li onclick="location.href='<?= base_url('topsis') ?>'"><i class="ph ph-equalizer"></i> <span>Perbandingan TOPSIS</span></li>
                <li onclick="location.href='<?= base_url('laporan') ?>'"><i class="ph ph-check-circle"></i> <span>Laporan</span></li>
            </ul>
        </div>

        <!-- MENU LOGOUT -->
        <div class="logout-section">
            <a href="<?= base_url('logout') ?>"><i class="ph ph-sign-out"></i> Logout</a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="header-title">
            Penerapan Metode AHP–TOPSIS pada Sistem Pendukung Keputusan Penetapan Sanksi<br>
            SMP NEGERI 3 BUKITTINGGI
        </div>

        <?php
          $jumlah_sanksi = isset($jumlah_sanksi) && is_array($jumlah_sanksi) ? $jumlah_sanksi : [];
          $labels_sanksi = [];
          $values_sanksi = [];
          foreach ($jumlah_sanksi as $r) {
            $labels_sanksi[] = $r['rekomendasi_sanksi'];
            $values_sanksi[] = (int)$r['total'];
          }
          $total_kasus = array_sum($values_sanksi);
          $sanksi_terbanyak = '-';
          if (!empty($values_sanksi)) {
            $idx = array_keys($values_sanksi, max($values_sanksi))[0];
            $sanksi_terbanyak = $labels_sanksi[$idx] . ' (' . $values_sanksi[$idx] . ')';
          }
        ?>

        <div class="info-row">
            <div class="info-box">Total Kasus: <?= $total_kasus ?></div>
            <div class="info-box">Sanksi Terbanyak: <?= esc($sanksi_terbanyak) ?></div>
        </div>

        <div class="cards">
            <div class="card">
                <h4>Statistik Jumlah Sanksi</h4>
                <canvas id="barChart"></canvas>
            </div>
            <div class="card">
                <h4>Perbandingan Jumlah Sanksi</h4>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const labelsSanksi = <?= json_encode($labels_sanksi) ?>;
        const valuesSanksi = <?= json_encode($values_sanksi) ?>;
        const barLabels = labelsSanksi.length ? labelsSanksi : ['Teguran','Penugasan','Pemanggilan','Skorsing','Dikeluarkan'];
        const barData = valuesSanksi.length ? valuesSanksi : [0,0,0,0,0];
        
        // Warna Aksen Baru: Mint/Pirus dan turunan
        const newColors = [
            '#2ecc71', // Mint utama
            '#1abc9c', // Pirus
            '#3498db', // Biru muda (kontras)
            '#f1c40f', // Kuning (peringatan)
            '#e74c3c', // Merah (berbahaya)
            '#9b59b6', // Ungu
            '#34495e'  // Gelap
        ];
        
        // Fungsi untuk menghasilkan warna Chart
        function getChartColors(count) {
            const colors = [];
            for (let i = 0; i < count; i++) {
                colors.push(newColors[i % newColors.length]);
            }
            return colors;
        }

        const chartColors = getChartColors(barLabels.length);

        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: barLabels,
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: barData,
                    backgroundColor: chartColors[0], 
                    borderColor: chartColors[0],
                    borderWidth: 1,
                    hoverBackgroundColor: '#27ae60' // Hover Mint lebih gelap
                }]
            },
            options: {
                responsive: true,
                plugins: { 
                    legend: { display: false },
                    title: { display: true, text: 'Total Pelanggaran per Jenis Sanksi' }
                },
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        ticks: { stepSize: 1 } 
                    } 
                }
            }
        });

        // Pie Chart
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: barLabels,
                datasets: [{
                    data: barData,
                    backgroundColor: chartColors, 
                    hoverOffset: 10
                }]
            },
            options: { 
                responsive: true,
                plugins: { 
                    legend: { position: 'top' },
                    title: { display: true, text: 'Proporsi Kasus Pelanggaran' }
                } 
            }
        });
    </script>
</body>
</html>