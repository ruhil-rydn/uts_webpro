<?php
include('../../config/conn_db.php');
session_start();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #3b82f6;
        }

        a.btn {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #3b82f6;
            color: white;
        }

        td a {
            text-decoration: none;
            color: #3b82f6;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2>📦 Data Produk</h2>
    <a href="add.php" class="btn">+ Tambah Produk</a>
    <a href="../dashboard.php" class="btn" style="background:#9333ea;">Kembali ke Dashboard</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= number_format($row['harga']); ?></td>
            <td><?= $row['stok']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
