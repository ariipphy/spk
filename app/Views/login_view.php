<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | SPK Penetapan Sanksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* 1. Reset dan Latar Belakang (DIPERBARUI) */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            
            /* WARNA BARU: Gradien Charcoal dan Mint yang Soft */
            background: linear-gradient(-45deg, #2c3e50, #34495e, #16a085, #2ecc71); 
            
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden; 
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* 2. Login Card */
        .login-card {
            background-color: #ffffff;
            padding: 35px 35px; 
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3); /* Sedikit bayangan lebih gelap untuk kontras */
            width: 100%;
            max-width: 420px;
            text-align: center;
            transition: transform 0.3s ease;
            max-height: 95vh; 
            overflow-y: auto; 
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }

        .login-card img:first-child { 
            width: 60px; 
            margin-bottom: 10px; 
        }

        .login-card h2 {
            font-weight: 800;
            margin-bottom: 5px;
            color: #1e293b;
        }
        
        .login-card h3 {
             font-weight: 600;
             font-size: 1.1rem;
             color: #64748b;
             margin-bottom: 25px; 
        }


        /* 3. Form Input Styling */
        .form-control {
            padding: 14px 15px; 
            font-size: 15px;
            border-radius: 10px;
            border: 1px solid #e2e8f0; 
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            /* Warna fokus tetap biru agar konsisten dengan tema utama */
            border-color: #3b82f6; 
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .input-group-text {
            background-color: #f8fafc;
            border-right: none;
            border-radius: 10px 0 0 10px !important;
            /* WARNA BARU: Biru tua agar serasi dengan tema dashboard */
            color: #1e3a8a; 
            padding: 14px;
        }

        /* 4. Tombol Login */
        .btn-login {
            margin-top: 15px;
            /* Tombol tetap biru agar konsisten dengan tema utama */
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4); 
        }

        .btn-login:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.6);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }

        /* PENYESUAIAN: Menghapus ilustrasi yang tidak terpakai */
        /* .illustration {
            margin-top: 15px;
            opacity: 0.7; 
        }
        .illustration img {
            width: 110px;
        } */
        
        /* Media Query untuk layar sangat kecil */
        @media (max-width: 480px), (max-height: 750px) {
             .login-card {
                padding: 30px 25px; 
            }
            .login-card p {
                margin-bottom: 20px;
            }
            .btn-login {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>

<div class="login-card">
    <!-- Icon Gembok -->
    <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" alt="Padlock">
    
    <h2>SISTEM PENDUKUNG KEPUTUSAN</h2>
    <h2> PENETAPAN SANKSI</h2>
    <h3>SMPN 3 Bukittinggi </h3>

    <!-- Form Login Utama -->
    <form id="loginForm" method="post" action="<?= base_url('auth/login') ?>">

        <?php 
        // Menggunakan session CodeIgniter untuk menampilkan pesan error
        if (session()->getFlashdata('error_message')): ?>
            <div class="alert alert-danger mb-3" role="alert">
                <?= session()->getFlashdata('error_message'); ?>
            </div>
        <?php endif; ?>
        
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username..." required>
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password..." required>
        </div>
        
        <button type="submit" class="btn btn-login" id="loginButton">
            LOGIN
        </button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function() {
        const button = document.getElementById('loginButton');
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        button.disabled = true;
    });
</script>

</body>
</html>