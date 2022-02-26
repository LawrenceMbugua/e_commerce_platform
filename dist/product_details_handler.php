<?php 

session_start();
include_once('connection.php');


if (!isset($_SESSION['username'])) {
  header('Location: login.html');
}

?>

<?php

$username = $_SESSION['username'];
$product_category = $_POST['product_category'];
$product_id = $_POST['product_id'];
$product_quantity = $_POST['product_quantity'];

$check_sql = "select * from cart where username = '$username' and 
product_category ='$product_category' and product_id = $product_id";

$present = mysqli_query($connection, $check_sql);

$num = mysqli_num_rows($present);

if ($num > 0) {

  $row = mysqli_fetch_assoc($present);
  $cart_product_quantity = $row['product_quantity'];

  $remainder = 10 - $cart_product_quantity;

  if ($product_quantity < $remainder) {
    
    $cart_product_quantity += $product_quantity;

  } else {

    $cart_product_quantity += $remainder;

  }


  $update_sql = "update cart set product_quantity = '$cart_product_quantity' where username = '$username' and product_category = '$product_category' and product_id = '$product_id'";

  $inserted = mysqli_query($connection, $update_sql);

  if (isset($inserted)) {
    header('Location: index.php');
    die();

  } else {
      header('location: product_details.php');
      die();
  }


}



$sql = "insert into cart(username, product_category, product_id, product_quantity) values('$username', '$product_category', '$product_id', '$product_quantity')";

$result = mysqli_query($connection, $sql);

if (isset($result)) {
    header('Location: index.php');
    
} else {
    header('location: product_details.php');
}



?>