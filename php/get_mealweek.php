<?php
    include "calorie_db.php";
    $conn = OpenCon();
    $data = array(
        array(
            "dayID" => "",
            "dayDate" => ""
        ),
        array(
            "dayID" => "",
            "dayDate" => ""
        ),
        array(
            "dayID" => "",
            "dayDate" => ""
        ),
        array(
            "dayID" => "",
            "dayDate" => ""
        ),
        array(
            "dayID" => "",
            "dayDate" => ""
        ),
        array(
            "dayID" => "",
            "dayDate" => ""
        ),
        array(
            "dayID" => "",
            "dayDate" => ""
        )
    );

    $daysql = "SELECT `dayID`, `dayDate` FROM `dayoffood` ORDER BY `dayDate` DESC LIMIT 7";
    $result = mysqli_query($conn, $daysql);
    $count = 0;

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[$count]["dayID"] = $row["dayID"];
            $data[$count]["dayDate"] = $row["dayDate"];
            $count = $count + 1; 
        }
    }

    mysqli_free_result($result);

    for($i = 0; $i < $count; $i++) {
        $mealsql = "SELECT * FROM `meal` WHERE `Fk_dayID` = ".$data[$i]["dayID"]."";
        $result = mysqli_query($conn, $mealsql);
        if(mysqli_num_rows($result) > 0) {
            $numrows = mysqli_num_rows($result);
            $bigtemparr = array();
            while($row = mysqli_fetch_assoc($result)) {
                $temparr = array();
                $temparr["foodEaten"] = $row["foodEaten"];
                $temparr["calories"] = $row["calories"];
                $temparr["fatContent"] = $row["fatContent"];
                $temparr["location"] = $row["location"];
                $temparr["notes"] = $row["notes"];
                array_push($bigtemparr, $temparr);
                unset($temparr);
            }
            array_push($data[$i], $bigtemparr);
            unset($bigtemparr);
            mysqli_free_result($result);
        }
    }

    $data["count"] = $count;
    
    header("Content-type:application/json;charset=utf-8");
    echo json_encode($data);
?>