<?php
include('../../config/conn_db.php');
session_start();

$id = $_GET['id'];
$conn->query("DELETE FROM products WHERE id = $id");

header("Location: index.php");
exit;
