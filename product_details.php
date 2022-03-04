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

  </head>
  <body>

  
    <!--Navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed">
      <div class="container-fluid" style='display: flex; justify-content: space-around;'>
      
        <a class="navbar-brand" href="index.php">
          <span class='text-warning fw-bold' style='border: 1px solid white; padding: 5px; border-radius: 5px;'>cloudMart</span>
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#mynavbar"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" style='display: flex; justify-content: space-between;' id="mynavbar">
          
          <form action="search_handler.php" method="post" class="d-flex">
            <input class="form-control me-2" type="text" placeholder="Search" name="search"/>
            <button class="btn btn-primary" type="submit">Search</button>
          </form>


         
          
          <?php
          $username = $_SESSION['username'];

          echo "<a href='profile.php'>Hello, $username</a>";
          
          ?>


           <?php 
              $username = $_SESSION['username'];

              $sql = "select * from cart where username = '$username';";

              $products = mysqli_query($connection, $sql);

              $total_quantity = 0;

              foreach($products as $product) {

                $product_quantity = $product['product_quantity'];
                $total_quantity += $product_quantity;

              }

              echo "<a href='cart.php'><span class='badge rounded-pill bg-warning mx-5'>$total_quantity</span></a>";
          ?>

            <a href="admin.php">Admin</a>

            <a href="logout_handler.php?">Logout</a>



        </div>
        
      </div>
    </nav>

    <!-- body-->

    <div class="container" style="margin-top: 40px">
      <div class="row">

  
    <!--Cards-->

     <div class="container" style="margin-top: 40px">
       <div class="row">

       <?php

      
           $product_category = $_GET['product_category'];
           $product_id = $_GET['product_id'];


           $sql = "select * from $product_category where product_id = $product_id";

           $product = mysqli_query($connection, $sql);

           $row = mysqli_fetch_assoc($product);

           
           $product_name = $row['product_name'];
           $product_price = $row['product_price'];
           $product_image = $row['product_image'];
           $product_description = $row['product_description'];


              echo "<div class='col-sm-12 col-md-8' '>
                      <img src='$product_image' alt='img' style='height: 400px; width:420px'>
                      <p>$product_name</p>
                      <p>Ksh.<span class='text-success'>$product_price</span></p>
                      <p>$product_description</p>
                  </div>



                  <div class='col-sm-12 col-md-4' '>
                      
                    <form action='product_details_handler.php' method='post'>

                      <div class='form-group'>
                        <input class='form-control' value='$product_category' type='text' name='product_category' readonly hidden>
                        <br><br>
                      </div>

                      <div class='form-group'>
                        <input class='form-control' value='$product_id' type='text' name='product_id' readonly hidden>
                        <br><br>
                      </div>


                      <div class='form-group'>

                          <select name='product_quantity' class='form-control'>
                              <option value='1'>1<option>
                              <option value='2'>2<option>
                              <option value='3'>3<option>
                              <option value='4'>4<option>
                              <option value='5'>5<option>
                          </select>

                          <br><br>
                      </div>

                      <div class='form-group'>
                        <input class='btn btn-primary' type='submit' name='add_to_cart' value='Add to Cart'>
                      </div>
                      
                    
                    </form>

                  </div>
                  <br>
                ";



        ?>

         
         

       </div>

     </div>


      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
