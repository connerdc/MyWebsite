<?php
    include 'calorie_db.php';
    $conn = OpenCon();

    $currDayID = $_POST["currDayID"];

    $foodEaten = $_POST["foodEaten"];
    $calories = $_POST["calories"];
    $fat = $_POST["fat"];

    $inputDate = $_POST["currDate"];
    $currDate=date("Y-m-d H:i:s",strtotime($inputDate));

    $location = $_POST["location"];
    $notes = $_POST["notes"];


    $daySQL = "INSERT INTO `dayoffood` (`dayID`, `dayDate`) VALUES (DEFAULT, '".$currDate."')";
    $mealSQL = "INSERT INTO `meal`(`mealID`, `calories`, `fatContent`, `foodEaten`, `location`, `notes`, `Fk_dayID`) 
                VALUES (DEFAULT, ".$calories.", ".$fat.", '".$foodEaten."', '".$location."', '".$notes."', ".$currDayID.")";

    mysqli_query($conn, $daySQL);

    mysqli_query($conn, $mealSQL);

    CloseCon($conn);
?>