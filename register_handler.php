<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}
?>


<?php

if (isset($_POST['register'])) {



    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_if_username_exists_sql = "select * from users where username = '$username'";

    $user = mysqli_query($connection, $check_if_username_exists_sql);

    $num = mysqli_num_rows($user);

    //If there's no user with such a name
    if ($num < 1) {

            $insert_users_sql = "insert into users(username, email, password) 
            values('$username', '$email', '$password')";

            $inserted = mysqli_query($connection, $insert_users_sql);

            if (isset($inserted)) {
                header('location: login.php');
            }

    //Else if there's such a name redirect to login with an error
    } else {
        $message = "Username already exists!";
        header("Location: login.php?message=$message");
    }
}


?>

