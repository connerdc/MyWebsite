<?php
    $sql = "SELECT * FROM manga";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th scope=\"row\">" . $row["mangaID"] . "</th>
        <td>" . $row["name"]. "</td>
        <td><a href=\"" . $row["link"] . "\">Link</a></td>
        <td id=\"specalign\">" . $row["completedCptr"] . "/" . $row["totalCptr"] . "</td>
        <td><button class=\"plusminusbtn\">+</button> </td>
        <td><button class=\"plusminusbtn\">-</button> </td>
        <td id=\"specalign\">" . $row["score"]. "</td>
        <td>" . $row["thoughts"]. "</td>
        <td id=\"editbtn\"><button>Edit</button>
        </tr>";
        }
    }
?>