<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully<br>";
// Create database
$sql = "CREATE DATABASE db_webpro5d";
if ($conn->query($sql) === TRUE) {
  echo "Database <strong> db_webpro5d created successfully";
} else {
  echo "Error creating database db_webpro5d: " . $conn->error;          
}

// Close connection
$conn->close();
?>
