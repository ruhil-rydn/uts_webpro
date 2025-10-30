<?php
session_start();
include '../config/conn_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if ($user['status'] !== 'AKTIF') {
      $error = "Akun belum aktif. Cek email untuk aktivasi.";
    } elseif (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      header("Location: dashboard.php");
      exit();
    } else {
      $error = "Password salah.";
    }
  } else {
    $error = "Email tidak ditemukan.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 40px; }
    .login-box {
      background: white; padding: 25px; max-width: 400px;
      margin: auto; border-radius: 10px; box-shadow: 0 0 8px rgba(0,0,0,.1);
    }
    input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
    button { background: teal; color: white; padding: 10px; border: none; width: 100%; border-radius: 5px; }
    .error { color: red; margin-bottom: 10px; }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Login Admin Gudang</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p><a href="forgot_password.php">Lupa password?</a></p>
  </div>
</body>
</html>
