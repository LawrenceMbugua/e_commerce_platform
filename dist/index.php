<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.html');
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
      }

    </style>
  </head>
  <body>


    <!--Navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed">
      <div class="container-fluid" style='display: flex; justify-content: space-around;'>
        <a class="navbar-brand" href="index.php">Logo</a>
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
        <div class="category col-md-3" >

        <ul>
          <li><a href="category.php?product_category=electronics">Electronics</a></li>
          <li><a href="category.php?product_category=fashion">Fashion</a></li>
          <li><a href="category.php?product_category=consumer_goods">Consumer goods</a></li>
          <li><a href="category.php?product_category=education">Education</a></li>
          <li><a href="category.php?product_category=hardware">Hardware</a></li>
          <li><a href="category.php?product_category=furniture">Furniture</a></li>
          
        </ul>

        </div>

        <div class="carousel col-md-6">

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
          <img src="./assets/mac.jpg" alt="image" class="d-block w-100" style='height: 400px;' >
        </div>
        <div class="carousel-item" style='height: 400px;'>
          <img src="assets/hoodie.jpg" alt="image" class="d-block w-100" style='height: 400px;'>
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

              echo "<div class='col-md-3'>
                      <a href='product_details.php?product_category=$product_category&product_id=$product_id'><img src='$product_image' alt='img' style='width:100px'></a>
                      <p>$product_name</p>
                      <p>Ksh.$product_price</p>
                  </div>
                  <br>
                ";
              
              }

       }


        ?>

         
         

       </div>

     </div>



      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
