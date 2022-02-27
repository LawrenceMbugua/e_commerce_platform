<?php 

session_start();
include_once('connection.php');


if (!isset($_SESSION['username'])) {
  header('Location: login.html');
}

$username = $_SESSION['username'];

$select_sql = "select * from users where username = '$username'";

$user_array = mysqli_query($connection, $select_sql);

$user = mysqli_fetch_assoc($user_array);

$is_admin = $user['is_admin'];

if(!$is_admin) {
  header('Location: index.php');
  die();
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
          echo "<a href='#'>Hello, $username</a>";
          
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

            //   echo "<a href='cart.php'><span class='badge rounded-pill bg-warning mx-5'>$total_quantity</span></a>";

          ?>
            <a href="orders.php">Orders</a>

            <a href='display_addresses.php'>Addresses</a>

            <a href="users.php">Users</a>

            <a href="logout_handler.php?">Logout</a>


        </div>
        
      </div>
    </nav>

    <!-- body-->
<div class="container mt-5">


  <?php
   //$current_time = date("h:i:sa");

   $username = $_SESSION['username'];

   $select_sessions = "select * from session";

   $sessions = mysqli_query($connection, $select_sessions);

   echo "<table class='mx-5'>
            <thead>
              <th>USERNAME</th>
              <th>Sign_in_time</th>
              <th>sign_out_time</th>
              <th>STATUS</th>
            </thead>
            <tbody>";
   foreach($sessions as $session) {
       $username = $session['username'];
       $sign_in_time = $session['sign_in_time'];
       $sign_out_time = $session['sign_out_time'];

 
       $status = '';

       if($sign_out_time == '') {
           $status = 'logged in';

       } else {
           $status = 'logged out';
       }

echo "<tr>
        <td>$username</td>
        <td>$sign_in_time</td>
        <td>$sign_out_time</td>
        <td>$status</td>
      </tr>";
   }
   
     ?>


   </div>
      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>





