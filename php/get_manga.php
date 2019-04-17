<?php
    include "db_connection.php";
    $conn = OpenCon();

    $mangaID = $_GET["mangaID"];

    $sql = "SELECT * FROM `manga` where `mangaID`= $mangaID";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        //$data = ["name" => $row["name"], "link" => $row["link"], "completedCptr" => $row["completedCptr"], "totalCptr" => $row["totalCptr"], "score" => $row["score"], "thoughts" => $row["thoughts"] ];

        $data = ["mangaID" => $mangaID, "name" => $row["name"], "link" => $row["link"], "completedCptr" => $row["completedCptr"], "totalCptr" => $row["totalCptr"], "score" => $row["score"], "thoughts" => $row["thoughts"] ];
    }

    header("Content-type:application/json;charset=utf-8");
    echo json_encode($data);
?>
