<?php
    include "calorie_db.php";
    $conn = OpenCon();

    $sql = "SELECT `dayDate` FROM `dayoffood` ORDER BY `dayDate` DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        //$data = ["name" => $row["name"], "link" => $row["link"], "completedCptr" => $row["completedCptr"], "totalCptr" => $row["totalCptr"], "score" => $row["score"], "thoughts" => $row["thoughts"] ];
        
        $data = ["dayDate" => $row["dayDate"]];
    }

    header("Content-type:application/json;charset=utf-8");
    echo json_encode($data);
?>