<?php

$db_host= "localhost";
$db_username = "root";
$db_password = "";
$db = "projekt1";

$conn = mysqli_connect($db_host,$db_username,$db_password,$db);
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");