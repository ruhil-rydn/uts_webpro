<?php
session_start();

// Jika user sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: pages/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            margin-top: 120px;
        }

        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 16px;
            margin-bottom: 30px;
        }

        a.btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin: 0 5px;
            transition: background-color 0.2s;
        }

        a.btn:hover {
            background-color: #0056b3;
        }

        footer {
            margin-top: 100px;
            color: #888;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistem Manajemen Pengguna</h1>
        <p>Kelola akun dan data produk Anda dengan mudah.</p>

        <a href="pages/login.php" class="btn">Login</a>
        <a href="pages/register.php" class="btn">Register</a>
    </div>

    <footer>
        &copy; <?= date('Y'); ?> Sistem Manajemen Pengguna
    </footer>
</body>
</html>
