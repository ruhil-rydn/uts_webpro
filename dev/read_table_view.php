<?php
include '../config/conn_db.php';

$sql = "SELECT id, name, description, price, created FROM products";
$result = $conn->query($sql);

echo "<a href='form_product.html'>Add Product</a><br>";

if ($result->num_rows > 0) {
    // buka tabel
    echo "<table border='1' cellspacing='0' cellpadding='8'>";
    echo "<tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Created</th>
            <th>Action</th>
          </tr>";

    // nomor urut
    $no = 1;

    // isi tabel
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $no++ . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["description"] . "</td>
                <td>" . $row["price"] . "</td>
                <td>" . $row["created"] . "</td>
                <td>
                    <a href='form_edit_product.php?id=" . $row["id"] . "'>Edit</a> | 
                    <a href='delete.php?id=" . $row["id"] . "' onclick=\"return confirm('Yakin hapus data ini?')\">Delete</a>
                </td>
              </tr>";
    }

    echo "</table>"; 
    // tutup tabel
} else {
    echo "0 results - Data not found";
}

$conn->close();
?>