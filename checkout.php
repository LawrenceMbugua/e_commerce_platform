<?php 

session_start();
include_once('connection.php');


if (!isset($_SESSION['username'])) {
  header('Location: login.html');
}





           $username = $_SESSION['username'];

           $cart_sql = "select * from cart where username = '$username'";

           $items = mysqli_query($connection, $cart_sql);
        
        foreach($items as $item) {

            $product_category = $item['product_category'];
            $product_id = $item['product_id'];
            $product_quantity = $item['product_quantity'];

            $sql = "select * from $product_category where product_id = '$product_id'";

            $product = mysqli_query($connection, $sql);

            $row = mysqli_fetch_assoc($product);

            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_image = $row['product_image'];
            
            $order_sql = "insert into orders(username, product_category, product_name, product_id, product_price, product_quantity) values ('$username','$product_category','$product_name','$product_id','$product_price','$product_quantity')";

            $inserted = mysqli_query($connection, $order_sql);

            if (isset($inserted)) {
                header('Location: address.php');
            }


        }  

?>