<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

if (isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];

    $delete_sql = "delete from users where id = '$user_id'";

    $deleted = mysqli_query($connection, $delete_sql);


    if (isset($deleted)) {
        header('Location: users.php');
    }



}

?>