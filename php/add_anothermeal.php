<?php
    //basically we already know the current date is in the database if we call this php file, so we get the most recent date and insert a meal to that date's ID

    include 'calorie_db.php';
    $conn = OpenCon();

    $foodEaten = $_POST["foodEaten"];
    $calories = $_POST["calories"];
    $fat = $_POST["fat"];
    $location = $_POST["location"];
    $notes = $_POST["notes"];

    $daysql = "SELECT `dayID` FROM `dayoffood` ORDER BY `dayDate` DESC LIMIT 1";
    $result = mysqli_query($conn, $daysql);
    $row = mysqli_fetch_assoc($result);
    $dayID = $row["dayID"];

    $mealSQL = "INSERT INTO `meal`(`mealID`, `calories`, `fatContent`, `foodEaten`, `location`, `notes`, `Fk_dayID`) 
                VALUES (DEFAULT, ".$calories.", ".$fat.", '".$foodEaten."', '".$location."', '".$notes."', ".$dayID.")";

    mysqli_query($conn, $mealSQL);

    CloseCon($conn);
?>