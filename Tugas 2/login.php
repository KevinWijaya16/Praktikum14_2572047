<!-- [2572047] - [Kevin Wijaya] -->
<?php
include "koneksi.php";

$user = $_POST['user'];
$password = $_POST['password'];

$query = mysqli_query(
    $conn, "SELECT * FROM users WHERE username='$user' OR email='$user'"
);

if(mysqli_num_rows($query) > 0){
    $data = mysqli_fetch_assoc($query);
    if(password_verify($password, $data['password'])){
        echo "
        <script>
            alert('Login berhasil!');
            window.location='dashboard.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Password salah!');
            window.location='Tugas2_2572047.php';
        </script>
        ";
    }
}else{
    echo "
    <script>
        alert('Username atau Email tidak ditemukan! Silakan register dulu.');
        window.location='Tugas2_2572047.php';
    </script>
    ";
}
?>