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
      th {
        color: red;
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

            <li class='nav-item'>
              <a class='nav-link text-info fw-bold' href="products.php">Products</a> 
            </li>

            <li class='nav-item'>
              <a class='nav-link text-info fw-bold' href="orders.php">Orders</a>
           </li>

            <li class='nav-item'>
              <a class='nav-link text-info fw-bold' href='display_addresses.php'>Addresses</a> 
            </li>

            <li class='nav-item'>
              <a class='nav-link text-info fw-bold' href="users.php">Users</a>
            </li>

            <li class='nav-item'>
              <a class='nav-link text-info fw-bold' href="session.php">Session</a>
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


    <div class='container mt-5'>
     <?php

        if (isset($_GET['message'])) {
            $message = $_GET['message'];

            echo "<h6 class='text-white text-center py-2 ' style='background: rgb(139, 158, 109);'>$message</h6>";
        }
     ?>
        <h3 class='text-center text-warning font-weight-bold'>INSERT A PRODUCT</h3>
      <form class='border p-2 bg-light' action="insert_products.php" method='post'>

        <div class="form-group">
            <label for="product_category">Product Category</label>

            <select class='form-control' name="product_category" id="product_category">

                <option value="electronics">Electronics</option>
                <option value="fashion">Fashion</option>
                <option value="consumer_goods">Consumer Goods</option>
                <option value="education">Education</option>
                <option value="hardware">Hardware</option>
                <option value="furniture">Furniture</option>

            </select>
            <br>
        </div>

        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input class='form-control' required type="text" id='product_name' name='product_name' class="form-control">
            <br>
        </div>

        <div class="form-group">
            <label for="product_price">Product Price</label>
            <input class='form-control' required type="text" id='product_price' name='product_price' class="form-control">
            <br>
        </div>

        <div class="form-group">
            <label for="product_image">Product Image</label>
            <input class='form-control' required type="text" id='product_image' name='product_image' class="form-control">
            <br>
        </div>

        <div class="form-group">
            <label for="product_description">Product Description</label>
            <input class='form-control' required type="text" id='product_description' name='product_description' class="form-control">
            <br>
        </div>

        <input type="submit" class='btn btn-warning' name='insert' value='Add Product'>

      </form>

       <?php

       
       

       $tables = array("electronics", "fashion", "consumer_goods", "education", "hardware", "furniture");

       foreach($tables as $table) {

           $sql = "select * from $table";
           $products = mysqli_query($connection, $sql);



            echo "<br><br>
            <h2 class='text-center text-danger' style='text-decoration: underline; text-transform: uppercase;'>$table</h2>";

         echo "<table class='table table-hover table-bordered' style='font-size: 18px;'>
                 <thead>
                  <tr class='sticky-top bg-light'>
                    <th>Image</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Category</th>
                    <th>Product Description</th> 
                    <th>Action</th>
                  </tr>
                 </thead>
                 <tbody>";

          foreach ($products as $row) {
              $product_name = $row['product_name'];
              $product_image = $row['product_image'];
              $product_price = $row['product_price'];
              $product_category = $row['product_category'];
              $product_id = $row['product_id'];
              $product_description = $row['product_description'];

              echo "
              <tr> 
                 <td><img src='$product_image' style='width: 100px; height: 80px;'></td>
                 <td>$product_id</td>
                 <td>$product_name</td>
                 <td>$product_price</td>
                 <td>$product_category</td>
                 <td>$product_description</td>

                 <td style='display: flex; justify-content: space-between; align-items: center;'>

                   <a class='btn btn-info' href='update_products.php?product_id=$product_id&product_category=$product_category'>Update</a>
                  
                   <a class='btn btn-danger' href='delete_products.php?product_id=$product_id&product_category=$product_category'>Delete</a>

                 </td>

              </tr>
            ";
              
              }
              echo "</tbody>
              </table> ";

       }

       
    


        ?>
    </div>



      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
