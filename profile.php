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

    <div class="container mt-5">

        <div class="row">

    <h3 class='text-warning text-center'>Your Address details are shown below</h3>

    <?php 

     $username = $_SESSION['username'];
     $sql = "select * from address where username = '$username'";

     $addresses = mysqli_query($connection, $sql);


     echo "<table class='table table-hover table-bordered table-striped'>
            <thead>
                <th>Username</th>
                <th>City</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>";

     foreach($addresses as $address) {
         $username = $address['username'];
         $city = $address['city'];
         $phone = $address['phone'];
         $email = $address['email'];

         $secret = 1;

        echo "<tr>
                <td>$username</td>
                <td>$city</td>
                <td>$phone</td>
                <td>$email</td>
                <td><a class='btn btn-info' href='profile.php?update=$secret'>UPDATE</a></td>
              </tr>";
     }

        echo "<tbody>
            </table>";

            if (isset($_GET['update'])) {

                foreach($addresses as $address) {
                    
                    $username = $_SESSION['username'];
                    $city = $address['city'];
                    $phone = $address['phone'];
                    $email = $address['email'];

                    echo "<div class='mt-5'>


                    <form action='update_addresses.php' method='post'>

                            <div class='from-group'>
                              <label for='username'>Username</label>
                               <input class='form-control' id='username' name='username' type='text' readonly value='$username'/>
                               <br><br>
                            </div>

                            <div class='from-group'>
                               <label for='city'>City</label>

                                <select class='form-control' name='city' id='select' >
                                    <option value='$city'>$city</option>
                                    <option value='Nairobi'>Nairobi</option>
                                    <option value='Kitengela'>Kitengela</option>
                                    <option value='Ongata Rongai'>Ongata Rongai</option>
                                    <option value='Kiserian'>Kiserian</option>
                                    <option value='Machakos'>Machakos</option>
                                    <option value='Thika'>Thika</option>
                                    <option value='Kiambu'>Kiambu</option>
                                </select>
                               <br><br>
                            </div>

                            <div class='from-group'>
                               <label for='phone'>Phone</label>
                               <input class='form-control' id='phone' name='phone' type='text' value='$phone'/>
                               <br><br>
                            </div>

                            <div class='from-group'>
                                <label for='email'>Email</label>
                               <input class='form-control' id='email' name='email' type='text' value='$email'/>
                               <br><br>
                            </div>

                            <input class='btn btn-primary' type='submit' name='update' value='update' />

                          </form>


                        </div>";
                }
            }
    
    ?>

        </div>
    </div>

      <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
