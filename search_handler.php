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

      .product_container {
        width: 200px;
        border-radius: 5px;
        
        box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.3), 0 7px 21px 0 rgba(0, 0, 0, 0.2);
      }

      .product_container:hover {
        
      }
 

    </style>
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


         
          <!-- <a href="logout_handler.php?">Logout</a> -->

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

            <a href="logout_handler.php?">Logout</a>  

        </div>
        
      </div>
    </nav>


    <!--Cards-->

     <div class="container" style="margin-top: 40px">
       <div class="row">

       <?php


        if (isset($_POST['search'])) {

         $search = $_POST['search'];


     
      // if($search == null ) {
      //     header('Location: index.php');
      //     die();
      // }

       $present = 1;
       $tables = array("electronics", "fashion", "consumer_goods", "education", "hardware", "furniture");

       foreach($tables as $table) {

           $sql = "select * from $table where product_name like '%$search%'";
           $products = mysqli_query($connection, $sql);

          if ($products) {

          
          foreach ($products as $row) {
              $product_name = $row['product_name'];
              $product_image = $row['product_image'];
              $product_price = $row['product_price'];
              $product_category = $row['product_category'];
              $product_id = $row['product_id'];

              $present += $product_id;

              echo "<div class='col-12 col-sm-6 col-md-4 col-xl-3'>


                      <div class='product_container'>

                          <a href='product_details.php?product_category=$product_category&product_id=$product_id'><img src='$product_image' alt='img' style='max-width:100%'></a>
                          <p>$product_name</p>
                          <p>Ksh. $product_price</p>

                      </div>



                   </div>
                  <br>
                ";
              
                } 

                
              } 

            }

             if ($present === 1) {
                    $not_found = "0";
                    //echo "Not Found!";
                    header("Location: index.php?not_found=$not_found");
             }
         }  

        
        ?>      

       </div>

     </div>

      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
