<?php
include('../config/conn_db.php');

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE activation_code = ? AND status = 'pending'");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $update = $conn->prepare("UPDATE users SET status='active' WHERE activation_code=?");
        $update->bind_param("s", $code);
        $update->execute();
        echo "<h3>Akun berhasil diaktifkan! Silakan <a href='login.php'>Login</a></h3>";
    } else {
        echo "<h3>Link aktivasi tidak valid atau akun sudah aktif.</h3>";
    }
}
?>
