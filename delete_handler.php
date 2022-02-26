<?php 

session_start();
include_once('connection.php');


if (!isset($_SESSION['username'])) {
  header('Location: login.html');
}

?>

<?php

$product_id = $_GET['product_id'];
$username = $_SESSION['username'];
$product_category = $_GET['product_category'];

$sql = "delete from cart where username = '$username' and product_id = '$product_id' and product_category='$product_category'";

$deleted = mysqli_query($connection, $sql);

if (isset($deleted)) {
    header('Location: cart.php');
}

?>