<?php
    include 'manga_db.php';
    $conn = OpenCon();

    $name = $_POST["name"];
    $link = $_POST["link"];
    $completedCptr = $_POST["completedCptr"];
    $totalCptr = $_POST["totalCptr"];
    $score = $_POST["score"];
    $status = $_POST["status"];
    $thoughts = $_POST["thoughts"];

    $sql = "INSERT INTO `manga` (mangaID, `name`, `link`, `completedCptr`, `totalCptr`, `score`, `status`, `thoughts`)
            VALUES (DEFAULT, '".addslashes($name)."', '$link', '$completedCptr', '$totalCptr', '$score', '$status', '".addslashes($thoughts)."')";

    if (mysqli_query($conn, $sql)) {
        echo "Successfully Saved!";
    } else {
        echo "Not Saved!";
    }
    CloseCon($conn);
?>