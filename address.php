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

            <a href="logout_handler.php?">Logout</a>



        </div>
        
      </div>
    </nav>

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
