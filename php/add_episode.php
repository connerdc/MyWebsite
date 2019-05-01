<?php
    include 'manga_db.php';
    $conn = OpenCon();

    $mangaID = $_POST["mangaID"];

    $sql = "SELECT `mangaID`, `completedCptr` FROM `manga` WHERE `mangaID`='$mangaID'";
    $result = (mysqli_query($conn, $sql));

    if(mysqli_num_rows($result) != 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $newCount = $row["completedCptr"] + 1;
            $sqlUpdate = "UPDATE `manga` SET `completedCptr`=$newCount WHERE `mangaID`=".$row["mangaID"];

            if (mysqli_query($conn, $sqlUpdate)) {
                echo "Successfully Saved!";
            } else {
                echo "Not Saved!";
            }
        }
    }

    CloseCon($conn);
?>