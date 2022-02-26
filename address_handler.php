<?php 

session_start();
include_once('connection.php');


if (!isset($_SESSION['username'])) {
  header('Location: login.html');
}


if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $check_sql = "select * from address where username = '$username'";

    $user = mysqli_query($connection, $check_sql);

    $num = mysqli_num_rows($user);

    if ($num > 0) {
        $delete_sql = "delete from cart where username = '$username'";

        $deleted = mysqli_query($connection, $delete_sql);

        if (isset($deleted)) {
           header('Location: invoice.php');
           die();
        }
    }

    $address_sql = "insert into address(username, city, phone, email) values('$username', '$city', '$phone', '$email');";

    $inserted = mysqli_query($connection, $address_sql);

    if (isset($inserted)) {

        $delete_sql = "delete from cart where username = '$username'";

        $deleted = mysqli_query($connection, $delete_sql);

        if (isset($deleted)) {
           header('Location: invoice.php');
        }

    }
    
}

?>

