<?php
include('../config/conn_db.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $activation_code = md5(rand());

    // Cek email sudah digunakan atau belum
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, activation_code) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $activation_code);
        if ($stmt->execute()) {
            // Kirim email aktivasi (sementara ditampilkan di layar)
            $activation_link = "http://localhost/uts_webprp/pages/activate.php?code=" . $activation_code;
            echo "<p>Registrasi berhasil! Klik link ini untuk aktivasi: <a href='$activation_link'>$activation_link</a></p>";
        } else {
            echo "Gagal mendaftar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pengguna</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="register">Daftar</button>
    </form>
</body>
</html>
