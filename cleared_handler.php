<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}


if (isset($_GET['order_number'])) {

    
    
    $order_number = $_GET['order_number'];
    
    $clear_sql = "update orders set order_status = 'cleared' where order_number='$order_number'";

    $updated = mysqli_query($connection, $clear_sql);

    
    header("Location: orders.php");
    
}
?>