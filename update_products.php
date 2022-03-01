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
        table, th, td {
            border: 1px solid;

        }
        table {
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;

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

              ?>
              <a href="orders.php">Orders</a>
  
              <a href='display_addresses.php'>Addresses</a> 

              <a href="users.php">Users</a>

              <a href="session.php">Session</a>

              <a href="logout_handler.php?">Logout</a>



        </div>
        
      </div>
    </nav>

    <!-- body-->


    <div class='container mt-5'>
       <?php


       if (isset($_GET['product_id'])) {
           # code...
       
        $product_category = $_GET['product_category'];
        $product_id = $_GET['product_id'];

        $sql = "select * from $product_category where product_id = '$product_id'";

        $product = mysqli_query($connection, $sql);

        $row = mysqli_fetch_assoc($product);

        $product_name = $row['product_name'];

        $product_category = $row['product_category'];

        $product_price = $row['product_price'];

        $product_description = $row['product_description'];

        $product_image = $row['product_image'];

        echo "<form action='update_products.php' method='post'>
            
                <div class='form-group'>

                    <label for='product_id'>Product ID</label>
                    <input class='form-control' id='product_id' value='$product_id' name='product_id' type='text' readonly>
                    <br></br>
                </div>

                <div class='form-group'>

                    <label for='product_category'>Product Category</label>
                    <input class='form-control' id='product_category' value='$product_category' name='product_category' type='text' readonly>
                    <br></br>
                </div>

                <div class='form-group'>

                    <label for='product_name'>Product Name</label>
                    <input class='form-control' id='product_name' value='$product_name' name='product_name' type='text'>
                    <br></br>
                </div>

                <div class='form-group'>

                    <label for='product_price'>Product Price</label>
                    <input class='form-control' id='product_price' value='$product_price' name='product_price' type='text'>
                    <br></br>
                </div>

                <div class='form-group'>

                    <label for='product_description'>Product Description</label>
                    <input class='form-control' id='product_description' value='$product_description' name='product_description' type='text'>
                    <br></br>
                </div>

                <div class='form-group'>

                    <label for='product_image'>Product Image URL</label>
                    <input class='form-control' id='product_image' value='$product_image' name='product_image' type='text'>
                    <br></br>
                </div>

                <input class='btn btn-success' type='submit' name='update' value='update'>
              </form>";
        
              }
              
              if (isset($_POST['product_id'])) {

                  $product_id = $_POST['product_id'];
                  $product_category = $_POST['product_category'];
                  $product_name = $_POST['product_name'];
                  $product_price = $_POST['product_price'];
                  $product_description = $_POST['product_description'];
                  $product_image = $_POST['product_image'];
                  

                  $sql = "update $product_category set product_name = '$product_name', product_price = '$product_price', product_description = '$product_description', product_image = '$product_image' where product_id = '$product_id'";

                  $updated = mysqli_query($connection, $sql);

                  if ($updated) {
                      $message = "Updated successfully!";
                      header("Location: products.php?message=$message");
                  }
                  
                  
              }

        ?>
    </div>



      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
