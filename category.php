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

    <div class="container" style="margin-top: 40px">
      <div class="row">

  
    <!--Cards-->

     <div class="container" style="margin-top: 40px">
       <div class="row">

       <?php
            if (isset($_GET['product_category'])) {
           
      
           $product_category = $_GET['product_category'];


           $sql = "select * from $product_category";
           $products = mysqli_query($connection, $sql);

          foreach ($products as $product) {
              $product_name = $product['product_name'];
              $product_image = $product['product_image'];
              $product_price = $product['product_price'];
              $product_category = $product['product_category'];
              $product_id = $product['product_id'];

              echo "<div  class='col-12 col-sm-6 col-md-4 col-xl-3 my-2'>
                      <div class='product_container'>


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

  


      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
