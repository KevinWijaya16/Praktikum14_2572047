<!-- [2572047] - [Kevin Wijaya] -->
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb_guest";

try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>