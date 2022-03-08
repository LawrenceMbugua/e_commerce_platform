<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
}

include_once('connection.php');

 ?>


<?php 
$username = $_SESSION['username'];

$product_id = $_GET['product_id'];
$product_category = $_GET['product_category'];

$sql = "select * from cart where username = '$username' and product_id= '$product_id' and product_category = '$product_category'";


$result = mysqli_query($connection, $sql);

$row = mysqli_fetch_assoc($result);

$product_quantity = $row['product_quantity'];

if ($product_quantity > 1) {
    $product_quantity--;
}


$update_sql = "update cart set product_quantity='$product_quantity' where username = '$username' and product_id = '$product_id' and product_category = '$product_category'";


$inserted = mysqli_query($connection, $update_sql);

if(isset($inserted)) {
    header("Location: cart.php");
}


?>