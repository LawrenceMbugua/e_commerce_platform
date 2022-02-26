<?php 

session_start();
include_once('connection.php');

?>


<?php

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users_sql = "insert into users(username, email, password) 
    values('$username', '$email', '$password')";

    $result = mysqli_query($connection, $users_sql);

    if (isset($result)) {
        header('location: login.html');
    }
}


?>

