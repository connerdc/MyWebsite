<?php
    include 'php/db_connection.php';
    $conn = OpenCon();

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $sql = "INSERT INTO `testtable` (nameID, `firstname`, `lastname`) VALUES (DEFAULT, '$firstname', '$lastname')";

    if (mysqli_query($conn, $sql)) {
        echo "Successfully saved";
    } else {

    }

    CloseCon($conn);
?>