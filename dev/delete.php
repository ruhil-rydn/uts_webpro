<?php
include '../config/conn_db.php';

// Ambil id dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Query hapus data produk
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect kembali ke daftar produk
        header("Location: read_table_view.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak valid!";
}

$conn->close();
?>