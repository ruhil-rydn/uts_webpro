<?php
include '../config/conn_db.php';

$sql = "SELECT name, description, price, created FROM products";
$result = $conn->query($sql);
// $row = $result->fetch_assoc();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()){
    // body of loop 
    echo "Name: " . $row["name"]. " - Description: " . $row["description"]. " - Price: " . $row["price"]. "<br>";
  }
} else {
  echo "0 results - Table is Empty";
}
$conn->close();
?>