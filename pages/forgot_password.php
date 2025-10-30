<?php
include('../config/conn_db.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Buat token unik untuk reset password
        $token = md5(rand());
        $update = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $update->bind_param("ss", $token, $email);
        $update->execute();

        // Link reset password (sementara tampilkan di layar)
        $reset_link = "http://localhost/uts_webpro/pages/reset_password.php?token=" . $token;
        echo "<p style='color:green; text-align:center;'>Tautan reset password: <a href='$reset_link'>$reset_link</a></p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Email tidak ditemukan!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            border: 1px solid #ddd;
            width: 320px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
        }

        input[type=email] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 12px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Lupa Password</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Masukkan Email Terdaftar" required>
        <button type="submit" name="submit">Kirim Tautan Reset</button>
        <a href="login.php">Kembali ke Login</a>
    </form>
</div>
</body>
</html>
