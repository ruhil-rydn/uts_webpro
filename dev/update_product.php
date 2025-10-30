<?php
// Ambil data dari form
$id        = isset($_POST['id']) ? intval($_POST['id']) : 0;
$prodName  = isset($_POST['name']) ? $_POST['name'] : '';
$prodDesc  = isset($_POST['description']) ? $_POST['description'] : '';
$prodPrice = isset($_POST['price']) ? $_POST['price'] : 0;

// Koneksi ke database
include "../config/conn_db.php";

// Escape untuk keamanan
$prodName  = $conn->real_escape_string($prodName);
$prodDesc  = $conn->real_escape_string($prodDesc);
$prodPrice = floatval($prodPrice);

// Query update
$sql = "UPDATE products 
        SET name='$prodName', 
            description='$prodDesc', 
            price=$prodPrice 
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // Redirect balik ke tabel
    header("Location: read_table_view.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>