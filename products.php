<?php
include 'db.php';

$db = new Database();
$pdo = $db->getConnection();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: products.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Product Page - Admin HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700"/>
    <link rel="stylesheet" href="css/fontawesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">
</head>

<body id="reportsPage">
<nav class="navbar navbar-expand-xl">

</nav>

<div class="container mt-5">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
                <h2 class="tm-block-title">Products</h2>
                <a href="index.php" class="btn btn-secondary mb-3">Return to Main Page</a>
                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                        <tr>
                            <th scope="col">PRODUCT NAME</th>
                            <th scope="col">UNIT SOLD</th>
                            <th scope="col">IN STOCK</th>
                            <th scope="col">EXPIRE DATE</th>
                            <th scope="col">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= htmlspecialchars($product['name']); ?></td>
                                <td><?= htmlspecialchars($product['sold']); ?></td>
                                <td><?= htmlspecialchars($product['stock']); ?></td>
                                <td><?= htmlspecialchars($product['expire']); ?></td>
                                <td>
                                    <a href="edit-product.php?id=<?= $product['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                    <a href="?delete=<?= $product['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="add-product.php" class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>