<!-- [2572047] - [Kevin Wijaya] -->
<?php
include "koneksi.php";

$message = '';
$alertClass = '';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");

    if(mysqli_num_rows($cek) > 0){
        $row = mysqli_fetch_assoc($cek);
        if($row['username'] == $username) {
            $message = 'Username sudah terdaftar.';
        } else {
            $message = 'Email sudah terdaftar.';
        }
        $alertClass = 'alert-danger';

    } else {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO users(username,email,password) VALUES('$username','$email','$hashPassword')");
        $message = 'Data berhasil disimpan! Silakan login.';
        $alertClass = 'alert-success';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - 2572047</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card p-4 mx-auto" style="max-width:400px;">
        <h2 class="text-center">Register</h2>
        <?php if(!empty($message)) { ?>
            <div class="alert <?= $alertClass ?> mt-4" role="alert">
                <?= $message ?>
            </div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">
                Register
            </button>
        </form>
       </form>

        <p class="text-center mt-3">
            Sudah punya akun? 
            <a href="Tugas2_2572047.php">Login</a>
        </p>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>