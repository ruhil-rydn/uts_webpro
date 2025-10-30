<?php
// Data to be inserted
$prodName = $_POST['name'];
$prodDesc = $_POST['description'];
$prodPrice = $_POST['price'];

// Create database connection
include "../config/conn_db.php";

// Insert data into table products
$sql = "INSERT INTO products(name, description, price) 
VALUES ('$prodName', '$prodDesc', $prodPrice)";

if ($conn->query($sql) === TRUE) {
  // echo "New record created successfully<br>";
  header('Location: read_table_new.php');
} else {
  echo "Error: " , $sql , "<br>" , $conn->error;
}

//Close connection
$conn->close();
?>


