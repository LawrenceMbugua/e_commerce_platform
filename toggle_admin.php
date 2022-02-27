<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

if (isset($_GET['user_id'])) {
    
    $user_id = $_GET['user_id'];

    $find_user_sql = "select * from users where id = '$user_id'";
  
    $users = mysqli_query($connection, $find_user_sql);

    foreach($users as $user) {
        $is_admin = $user['is_admin'];
        
        if($is_admin == true) {
            $is_admin = false;
        } else {
            $is_admin = true;
        }

        $insert_sql = "update users set is_admin = '$is_admin' where id = '$user_id'";

        $inserted = mysqli_query($connection, $insert_sql);
    }

    header('Location: users.php');

}


?>