<!-- [2572047] - [Kevin Wijaya] -->

<?php
include_once "koneksi.php";

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword != '') {
    $sql = "SELECT id, firstname, email FROM MyGuests WHERE firstname LIKE :keyword OR email LIKE :keyword";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
} else {
    $sql = "SELECT id, firstname, email FROM MyGuests";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP</title>
</head>
<body>

<h1>Hallo Aku Kevin</h1>

<?php
$nama = "Kevin";
echo "<p>Nama saya $nama</p>";
?>

<h2>Hai, <?php echo $nama; ?></h2>

<fieldset>
    <legend>Input Data</legend>
    <form action="proses.php" method="POST">
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="submit" name="btn" value="Simpan">
    </form>
</fieldset>

<br>

<form action="" method="GET">
    <input type="text" name="keyword" placeholder="Cari data..." value="<?php echo htmlspecialchars($keyword); ?>">
    <input type="submit" value="Cari">
</form>

<br>

<?php
$msg = isset($_GET['msg']) ? trim($_GET['msg']) : '';
echo "<span style='color:green;'>$msg</span>";
?>

<br><br>

<table border="1" cellpadding="5" style="border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Email</th>
    </tr>

    <?php
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td colspan='3'>Data tidak ditemukan</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>