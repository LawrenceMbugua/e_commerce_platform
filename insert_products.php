<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}


if (isset($_POST['insert'])) {
           
            $product_category = $_POST['product_category'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_description = $_POST['product_description'];

            $insert_sql = "insert into $product_category(product_category, product_name, product_price, product_image, product_description) 
            values('$product_category', '$product_name', '$product_price', '$product_image', '$product_description')";

            $inserted = mysqli_query($connection, $insert_sql);

           

                $message = "Product inserted successfully!";
                header("Location: products.php?message=$message");
            

       }

?>