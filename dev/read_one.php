<?php
include 'config/conn_db.php';

$sql = "SELECT * FROM products WHERE id=3";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
  // output data of each row
    echo " Name: " . $row["name"]. " - Description: " . $row["description"]. " - Price: " . $row["price"].  " - Created: " . $row["created"]. "<br>";
} else {
  echo "0 results - Data not found";
}
$conn->close();
?>