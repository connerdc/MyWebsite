<?php
    //This will return current day information along with meal data for current day. Might wanna clean up array stuff in here to be more like get_mealweek

    include "calorie_db.php";
    $conn = OpenCon();

    $daysql = "SELECT `dayID`, `dayDate` FROM `dayoffood` ORDER BY `dayDate` DESC LIMIT 1";
    $result = mysqli_query($conn, $daysql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $data = ["dayID" => $row["dayID"], "dayDate" => $row["dayDate"]];
    }

    mysqli_free_result($result);

    $mealsql = "SELECT * FROM `meal` WHERE `Fk_dayID` = ".$data["dayID"]."";
    $result = mysqli_query($conn, $mealsql);

    $count = 0;

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $count = $count + 1; 
            $data += [$count."meal" => array("calories" => $row["calories"], "fat" => $row["fatContent"], "foodEaten" => $row["foodEaten"], "location" => $row["location"], "notes" => $row["notes"])];
        }
    }

    $data += ["mealCount" => $count];

    mysqli_free_result($result);

    header("Content-type:application/json;charset=utf-8");
    echo json_encode($data);
?>