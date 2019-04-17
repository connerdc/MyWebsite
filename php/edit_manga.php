<?php
    include 'db_connection.php';
    $conn = OpenCon();

    $mangaID = $_POST["mangaID"];
    $name = $_POST["name"];
    $link = $_POST["link"];
    $completedCptr = $_POST["completedCptr"];
    $totalCptr = $_POST["totalCptr"];
    $score = $_POST["score"];
    $status = $_POST["status"];
    $thoughts = $_POST["thoughts"];

    /*$sql = "INSERT INTO `manga` (mangaID, `name`, `link`, `completedCptr`, `totalCptr`, `score`, `thoughts`)
            VALUES (DEFAULT, '".addslashes($name)."', '$link', '$completedCptr', '$totalCptr', '$score', '".addslashes($thoughts)."')";*/

    $sql = "UPDATE `manga` SET `name`='".addslashes($name)."',`link`='$link',`completedCptr`='$completedCptr',`totalCptr`='$totalCptr',`score`='$score', `status`='$status', 
            `thoughts`='".addslashes($thoughts)."' WHERE `mangaID`='$mangaID'";

    if (mysqli_query($conn, $sql)) {
        echo "Successfully Saved!";
    } else {
        echo "Not Saved!";
    }
    CloseCon($conn);
?>
