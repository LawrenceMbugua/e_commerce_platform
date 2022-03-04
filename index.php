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


    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <style>

      ul > li {
        list-style-type: none;
        border-bottom: 1px solid;
        margin-left: 0px;
        text-align: left;
        padding: 10px 10px;
      }

      ul > li > a {
        text-decoration: none;
        color: gold;
        font-weight: bold;
        font-size: 15px;
      }

      .product_container {
        width: 200px;
        border-radius: 5px;
        box-shadow:0 5px 10px 0 rgba(0, 0, 0, 0.3), 0 7px 21px 0 rgba(0, 0, 0, 0.2);
      }


    </style>
  </head>
  <body>


    <!--Navbar-->

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
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
            <span class='badge rounded-pill bg-warning '>

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



    <!-- body-->
    <br>

    <div class="container mt-1">
      <div class="row mt-5">
        <?php

    if (isset($_GET['not_found'])) {

      $not_found = $_GET['not_found'];
      $not_found= "Product not found!";
      
      echo "<p class='text-danger text-center mt-1'>$not_found</p>";
      

    } else if(  isset($_GET['message']) ) {
      $message = $_GET['message'];
      $message = "Access Denied! You are not an admin.";

      echo "<p class='text-danger text-center mt-1'>$message</p>";

    }
     ?>
        <div class="category col-sm-12 col-md-3" >


          <ul>

            <li><a href="category.php?product_category=electronics">Electronics</a></li>
            <li><a href="category.php?product_category=fashion">Fashion</a></li>
            <li><a href="category.php?product_category=consumer_goods">Consumer goods</a></li>
            <li><a href="category.php?product_category=education">Education</a></li>
            <li><a href="category.php?product_category=hardware">Hardware</a></li>
            <li><a href="category.php?product_category=furniture">Furniture</a></li>
            
          </ul>


        </div>

        <div class="carousel col-sm-12 col-md-7">

          <!-- Carousel -->
      <div id="demo" class="carousel slide" data-bs-ride="carousel">

      <!-- Indicators/dots -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
      </div>

      <!-- The slideshow/carousel -->
      <div class="carousel-inner">
        <div class="carousel-item active" style='height: 400px;'>
          <img src="./assets/hoodie.jpg"  alt="image" class="d-block w-100" style='height: 400px;' >
        </div>
        <div class="carousel-item" style='height: 400px;'>
          <img src="./assets/mac.jpg" alt="image" class="d-block w-100" style='height: 400px;'>
        </div>
        <div class="carousel-item" style='height: 400px;'>
          <img src="assets/chair.jpg" alt="image" class="d-block w-100" style='height: 400px;'>
        </div>
      </div>

      <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

        </div>

        <div class="ads col-md-3" >

         
        </div>

      </div>
    </div>

    <!--Cards-->

     <div class="container" style="margin-top: 40px">
       <div class="row">

       <?php

       $tables = array("electronics", "fashion", "consumer_goods", "education", "hardware", "furniture");

       foreach($tables as $table) {
           $sql = "select * from $table limit 4";
           $products = mysqli_query($connection, $sql);

          foreach ($products as $row) {
              $product_name = $row['product_name'];
              $product_image = $row['product_image'];
              $product_price = $row['product_price'];
              $product_category = $row['product_category'];
              $product_id = $row['product_id'];

              echo "<div class='col-12 col-sm-6 col-md-4 col-xl-3  my-2' >

                    <div class='product_container '>

                      <a href='product_details.php?product_category=$product_category&product_id=$product_id'><img src='$product_image' alt='img' style='max-width: 100%'></a>

                        <div class='text-center fs-5' style='padding: 5px; '>

                          <p>$product_name</p>
                          <p>Ksh.$product_price</p>

                        </div>

                      </div>


                  </div>
                  <br>
                ";
              
              }

       }


        ?>

         
         

       </div>

     </div>

      <div class="footer bg-dark text-white mt-5 px-5 py-5" style='height: 30vh;'>

        <p class='me-0'> &copy; Copyright 2022 | All Rights Reserved.</p>

      </div>

      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
