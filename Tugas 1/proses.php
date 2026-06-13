<!-- [2572047] - [Kevin Wijaya] -->
<?php

include_once "koneksi.php";

$firstname = filter_input(INPUT_POST, 'fname');
$email = filter_input(INPUT_POST, 'email');
$simpan = filter_input(INPUT_POST, 'btn');

if ($simpan) {

    try {

        $sql = "INSERT INTO MyGuests(firstname, email)
                VALUES(:fname, :email)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':fname' => $firstname,
            ':email' => $email
        ]);

        $msg = "New record created successfully";

    } catch(PDOException $e) {

        $msg = "Error : " . $e->getMessage();
    }

    header("Location: index.php?msg=" . urlencode($msg));
    exit;
}
?>