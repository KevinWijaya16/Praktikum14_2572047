<!-- [2572047] - [Kevin Wijaya] -->
<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - 2572047</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <div class="alert alert-success py-3" role="alert">
        Selamat datang, <strong><?= htmlspecialchars($username) ?></strong>
    </div>
    <a href="login.php" class="btn btn-danger">
        Logout
    </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>