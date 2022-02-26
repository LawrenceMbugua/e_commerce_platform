<?php 

session_start();
include_once('connection.php');


if (!isset($_SESSION['username'])) {
  header('Location: login.html');
}


 
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];


    $update_sql = "update address set username = '$username', city = '$city', phone='$phone', email='$email' where username = '$username'";

    $updated = mysqli_query($connection, $update_sql);

    if (isset($updated)) {
        header('Location: profile.php');
    }

}

?>

