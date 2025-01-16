<?php
include 'db.php';

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $sold = $_POST['sold'];
    $stock = $_POST['stock'];
    $expire = $_POST['expire'];

    $stmt = $pdo->prepare("INSERT INTO products (name, sold, stock, expire) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $sold, $stock, $expire]);

    header('Location: products.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Add Product - Admin HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700"/>
    <link rel="stylesheet" href="css/fontawesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">
</head>
<body>
<div class="container mt-5">
    <h2>Add Product</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sold">Unit Sold</label>
            <input type="number" name="sold" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stock">In Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="expire">Expire Date</label>
            <input type="date" name="expire" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
        <a href="products.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
