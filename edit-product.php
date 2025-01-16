<?php
include 'db.php';

$db = new Database();
$pdo = $db->getConnection();

if (!isset($_GET['id'])) {
    die('Product ID not provided.');
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $sold = $_POST['sold'];
    $stock = $_POST['stock'];
    $expire = $_POST['expire'];

    $stmt = $pdo->prepare("UPDATE products SET name = ?, sold = ?, stock = ?, expire = ? WHERE id = ?");
    $stmt->execute([$name, $sold, $stock, $expire, $id]);

    header('Location: products.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die('Product not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Product - Admin HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700"/>
    <link rel="stylesheet" href="css/fontawesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Product</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="sold">Unit Sold</label>
                <input type="number" name="sold" class="form-control" value="<?= htmlspecialchars($product['sold']); ?>" required>
        </div>
        <div class="form-group">
            <label for="stock">In Stock</label>
            <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars($product['stock']); ?>" required>
        </div>
        <div class="form-group">
            <label for="expire">Expire Date</label>
            <input type="date" name="expire" class="form-control" value="<?= htmlspecialchars($product['expire']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="products.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>