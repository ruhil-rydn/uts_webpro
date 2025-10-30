<?php
include('../config/conn_db.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Cek token valid atau tidak
    $query = $conn->prepare("SELECT * FROM users WHERE reset_token = ?");
    $query->bind_param("s", $token);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 0) {
        die("<p style='color:red;'>Token tidak valid atau sudah digunakan.</p>");
    }

    if (isset($_POST['reset'])) {
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
        $update->bind_param("ss", $new_password, $token);
        $update->execute();

        echo "<p style='color:green;'>Password berhasil diperbarui! <a href='login.php'>Login sekarang</a></p>";
    }
} else {
    die("<p style='color:red;'>Token tidak ditemukan.</p>");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #9333ea, #3b82f6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #9333ea;
            margin-bottom: 20px;
        }
        input[type=password] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background: #9333ea;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #7e22ce;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reset Password</h2>
    <form method="POST">
        <input type="password" name="password" placeholder="Masukkan Password Baru" required><br>
        <button type="submit" name="reset">Ubah Password</button>
    </form>
</div>
</body>
</html>
