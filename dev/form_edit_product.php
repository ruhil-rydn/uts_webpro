<?php
include '../config/conn_db.php';

// ambil id dari url
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT id, name, description, price, created 
        FROM products 
        WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Data dengan ID $id tidak ditemukan di tabel products");
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Product</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Input New Product</h2>
  <form action="create.php" method="POST">
    <div class="mb-3">
      <label for="name" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo $row["name"]; ?>" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Product Description</label>
      <textarea class="form-control" id="description" name="description" value="<?php echo $row["description"]; ?>"></textarea>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Product Price</label>
      <input type="number" class="form-control" id="price" name="price" value="<?php echo $row["price"]; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Update Product</button>
  </form>
</div>

</body>
</html>