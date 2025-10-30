<?php
include('../../config/conn_db.php');
session_start();

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $stmt = $conn->prepare("UPDATE products SET nama=?, harga=?, stok=? WHERE id=?");
    $stmt->bind_param("siii", $nama, $harga, $stok, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Gagal mengedit produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
</head>
<body>
    <h2>Edit Produk</h2>
    <form method="POST">
        <label>Nama Produk:</label><br>
        <input type="text" name="nama" value="<?= $product['nama']; ?>" required><br><br>

        <label>Harga:</label><br>
        <input type="number" name="harga" value="<?= $product['harga']; ?>" required><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" value="<?= $product['stok']; ?>" required><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
