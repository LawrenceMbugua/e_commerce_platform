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

    <style>
   

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


    <div class='container mt-5'>
        <div class="row">
            <h1>Address </h1>
            <form action='address_handler.php' method='post'>
                <div class="form-group">
                    <label for="city">City</label>

                    <select class='form-control' name="city" id="select" >
                        <option value="Nairobi">Nairobi</option>
                        <option value="Kitengela">Kitengela</option>
                        <option value="Ongata Rongai">Ongata Rongai</option>
                        <option value="Kiserian">Kiserian</option>
                        <option value="Kiambu">Kiambu</option>
                        <option value="Machakos">Machakos</option>
                        <option value="Thika">Thika</option>
                    </select>
                </div>
                <br><br>

                <div class="form-group">
                    <input type="text" class="form-control" name='phone' placeholder='Phone'>
                </div>
                <br><br>

                <div class="form-group">
                    <input type="email" class="form-control" name='email' placeholder='email'>
                </div>
                <br><br>

                <input class='btn btn-primary' type='submit' name='submit' value='submit'>
            </form>
        </div>

    </div>

      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
