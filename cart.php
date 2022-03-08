<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <!-- Latest compiled and minified CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>

    </style>
  </head>
  <body>

    <!--Navbar-->

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
       <div class="container-fluid">


        <a class="navbar-brand fw-bold" href="index.php">
          <span class='text-warning fw-bold bg-dark' style='border: 1px solid white; padding: 5px; border-radius: 5px;'>cloudMart</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
          <span class="navbar-toggler-icon"></span>
        </button>



    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">


          <a class="nav-link text-info fw-bold" href="profile.php">

            <?php
                $username = $_SESSION['username'];
                echo "Hello, $username";
              ?>

          </a>



        </li>

        <li class="nav-item">

          <a  class="nav-link text-warning fw-bold btn btn-primary fw-bold" href="cart.php">
            Cart 
            <span class='badge rounded-pill bg-warning'>

                      <?php 
                        $username = $_SESSION['username'];

                        $sql = "select * from cart where username = '$username';";

                        $products = mysqli_query($connection, $sql);

                        $total_quantity = 0;

                        foreach($products as $product) {

                          $product_quantity = $product['product_quantity'];
                          $total_quantity += $product_quantity;

                        }

                        echo "$total_quantity";

                      ?>

            </span>
          </a>
          
        </li>

        <li class="nav-item">
          <a class="nav-link text-info fw-bold" href="admin.php">Admin</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-info fw-bold" href="logout_handler.php?">Logout</a>
        </li>

      </ul>

        <form action="search_handler.php" method="post" class="d-flex">
            <input class="form-control me-2" type="text" placeholder="Search" name="search"/>
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

      </div>
      </div>


    </nav>

    <!-- end of Navbar -->


 <?php

           

           $username = $_SESSION['username'];

           $cart_sql = "select * from cart where username = '$username'";

           $items = mysqli_query($connection, $cart_sql);

           $total_price = 0;

            echo "
            <div class='container mt-5'>  

                <div class='row'>

                   <div class='row col-md-8' >
            ";
                
              if ($total_quantity > 0) {

                echo "<h3 class='text-warning text-center'>Here are the items in your cart</h3>";

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

                  
                  $total_price += $product_price*$product_quantity;
                
  
                
                
                  
                echo "
                        <div  style='display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid; width: 95%; background: whitesmoke;'>

                            <div class='product_details' style='width: 300px;'>
                              <img src='$product_image' alt='img' style='width:100px'>

                              <p>$product_name</p>
                              <p>Ksh.$product_price</p>
                            </div>
                          
                            <a class='btn btn-warning' href='increment_handler.php?product_id=$product_id&product_category=$product_category'>+</a>
    
                              <span style='font-size: 20px;'>$product_quantity</span>
    
                            <a class='btn btn-warning' href='decrement_handler.php?product_id=$product_id&product_category=$product_category'>-</a>

                            <a href='delete_handler.php?product_id=$product_id&product_category=$product_category' class='btn btn-danger'>Remove</a>
                            
                        </div>
                      
                    ";

                }
              
                echo "
                      </div>
                      <div class='col-md-4' style='background: whitesmoke; padding: 20px; border-radius: 10px;'>
                            <h3>CART SUMMARY</h3>
                          <p>Total Quantity: ($total_quantity)</p>
                          <p>Subtotal: Ksh. $total_price</p>
                            <a class='btn btn-success' href='checkout.php'>CHECKOUT</a>
                        

                         
                      </div>

                   </div>
                
                </div>";

                } else {
                  echo "<h3 class='text-center'>There are no items in the cart!</h3>
                  <a class='btn btn-success' href='index.php'>CONTINUE SHOPPING</a>";
                }


        ?>


  <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
