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

    <?php 


    $sql = "select * from orders";

    $products = mysqli_query($connection, $sql);



    echo "
        <div class='container-fluid mt-5'>
        <div class='row'>
            <div class='col-sm-12'>
                <h3 class='text-center text-danger'>ORDERS</h2>

                <table class='table table-hover table-bordered table-striped fs-5 table-responsive'>
                    <thead>
                        <tr class='bg-secondary-light sticky-top'>
                            <th>Username</th>
                            <th>Product Category</th>
                            <th>Product Name</th>
                            <th>Product ID</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Ordered at</th>
                            <th>Order Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

                      //Start of foreach
                      foreach($products as $product) {
                          $username = $product['username'];
                          $product_category = $product['product_category'];
                          $product_name = $product['product_name'];
                          $product_price = $product['product_price'];
                          $product_id = $product['product_id'];
                          $product_quantity = $product['product_quantity'];
                          $order_time = $product['order_time'];
                          $order_number = $product['order_number'];
                          $order_status = $product['order_status'];


                          echo " <tr>
                               <td>$username</td>
                               <td>$product_category</td>
                               <td>$product_name</td>
                               <td>$product_id</td>
                               <td>$product_price</td>
                               <td>$product_quantity</td>
                               <td>$order_time</td>
                               <td>$order_number</td>

                               <td>$order_status</td>

                               <td>
                                  <a href='cleared_handler.php?order_number=$order_number' class='btn btn-success'>Clear</a>

                                  <a href='delete_order.php?order_number=$order_number' class='btn btn-danger'>Delete</a>
                               </td>
                           </tr>";
                      }
                        //End of foreach

                  echo "</tbody>
                </table>
            </div>
        </div>
    </div>";
    ?>




      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
