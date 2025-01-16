<?php
include 'db.php';

$db = new Database();
$pdo = $db->getConnection();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $account_type = $_POST['account_type'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($name && $email && $account_type) {
        if ($id) {

            $stmt = $pdo->prepare('UPDATE accounts SET name = ?, email = ?, account_type = ? WHERE id = ?');
            $stmt->execute([$name, $email, $account_type, $id]);
        } else {

            $stmt = $pdo->prepare('INSERT INTO accounts (name, email, account_type) VALUES (?, ?, ?)');
            $stmt->execute([$name, $email, $account_type]);
        }
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM accounts WHERE id = ?');
    $stmt->execute([$id]);
}


$stmt = $pdo->query('SELECT id, name, email, account_type FROM accounts');
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Accounts - Product Admin Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700"/>
    <link rel="stylesheet" href="css/fontawesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">
</head>
<body id="reportsPage">
<div class="" id="home">
    <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
            <a class="navbar-brand" href="index.php">
                <h1 class="tm-site-title mb-0">Product Admin</h1>
            </a>
            <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars tm-nav-icon"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto h-100">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">
                            <i class="fas fa-shopping-cart"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="accounts.php">
                            <i class="far fa-user"></i> Accounts
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row tm-content-row">
            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <h2 class="tm-block-title">Manage Accounts</
                    </h2>

                    <form method="post" action="">
                        <input type="hidden" name="id" id="formId">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <select name="account_type" class="form-control" required>
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                                <option value="Merchant">Merchant</option>
                                <option value="Customer">Customer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Potvrd</button>
                    </form>


                    <table class="table table-striped table-dark mt-3">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Account Type</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($accounts as $account): ?>
                            <tr>
                                <td><?= htmlspecialchars($account['name']); ?></td>
                                <td><?= htmlspecialchars($account['email']); ?></td>
                                <td><?= htmlspecialchars($account['account_type']); ?></td>
                                <td>
                                    <button class="btn btn-warning" onclick="editRecord(<?= $account['id'] ?>, '<?= htmlspecialchars($account['name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($account['email'], ENT_QUOTES) ?>', '<?= $account['account_type'] ?>')">Edit</button>
                                    <a class="btn btn-danger" href="?delete=<?= $account['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
            <p class="text-center text-white mb-0 px-4 small">
                Copyright &copy; <b>2018</b> All rights reserved.
                Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
            </p>
        </div>
    </footer>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    function editRecord(id, name, email, accountType) {
        // Nastavenie hodnôt formulára pre úpravu záznamu
        document.getElementById('formId').value = id;
        document.querySelector('input[name="name"]').value = name;
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('select[name="account_type"]').value = accountType;
    }
</script>
</body>
</html>