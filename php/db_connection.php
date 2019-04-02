<?php

function OpenCon()
{
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "giraffegolfing1995";
 $db = "itemdatabase";

 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 return $conn;
}

function CloseCon($conn)
{
 $conn -> close();
}

?>
