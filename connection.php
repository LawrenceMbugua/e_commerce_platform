<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "e_commerce_platform";

//Connect to the DB
$connection = mysqli_connect($host, $user, $pass, $db_name);


//Check if connection failed
if (!isset($connection)) {
    die("Db connection failed!");
}
