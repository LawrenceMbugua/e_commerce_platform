<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}



if (isset($_GET['product_id'])) {
           
       
        $product_category = $_GET['product_category'];
        
        $product_id = $_GET['product_id'];

        $sql = "delete from $product_category where product_id = '$product_id'";

        $deleted = mysqli_query($connection, $sql);

       
        if ($deleted) {

            $message = "Deleted Successfully!";
            header("Location: products.php?message=$message");

        }
                  
                  
      }

?>

