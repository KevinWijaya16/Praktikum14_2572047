<!-- [2572047] - [Kevin Wijaya] -->
<?php
include "koneksi.php";

$message = '';
$alertClass = '';

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' OR email='$user'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        if (password_verify($password, $data['password'])) {
            echo "
            <script>
                alert('Login berhasil!');
                window.location='dashboard.php';
            </script>
            ";
            exit;
        } else {
            $message = 'Password salah!';
            $alertClass = 'alert-danger';
        }
    } else {
        $message = 'Username atau Email tidak ditemukan! Silakan register dulu.';
        $alertClass = 'alert-danger';
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LoginRegister - 2572047</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  </head>
  <body>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h2 class="text-center">Login</h2>
                 <?php if(!empty($message)) { ?>
                    <div class="alert <?= $alertClass ?> mt-4" role="alert">
                        <?= $message ?>
                    </div>
                <?php } ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Username / Email</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-success w-100">
                        Login
                    </button>
                </form>

                <p class="text-center mt-3">
                    Belum punya akun?
                    <a href="register.php">Register</a>
                </p>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>