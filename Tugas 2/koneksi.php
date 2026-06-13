<!-- [2572047] - [Kevin Wijaya] -->
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "mydb_guest";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Koneksi gagal : " . mysqli_connect_error());
}
?>