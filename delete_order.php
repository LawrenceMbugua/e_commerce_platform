<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}




if (isset($_GET['order_number'])) {

    $order_number = $_GET['order_number'];

    $delete_sql = "delete from orders where order_number='$order_number'";

    $deleted = mysqli_query($connection, $delete_sql);

    header('Location: orders.php');

}

?>