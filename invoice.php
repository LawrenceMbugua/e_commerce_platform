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
     table {
         background: whitesmoke;
     }
     table, th, td {
          border: 1px solid;
          border-collapse: collapse;
      }

      th, td {
          padding: 10px;
          text-align: center;
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

    <div class="container mt-5">
        
       <?php
        
        $sql = "select * from orders where username = '$username'";

        $products = mysqli_query($connection, $sql);

        $total_charge = 0;

        echo "<div class='row'>
                <th><span class='text-center'>ORDER SUMMARY</span><th>
                <table class='table'>
                      <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>TOTAL</th>
                      </tr>
                      </thead>
                      <tbody>
                ";
        
        foreach($products as $product) {

            $product_name = $product['product_name'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];
            $product_subtotal = $product_price * $product_quantity;

            $total_charge += $product_subtotal;

            echo "<tr>

                    <td>$product_name</td>
                    <td>$product_price</td>
                    <td>$product_quantity</td>
                    <td>$product_subtotal</td>

               </tr>";
                    
                
            
        }
            
          
        echo "
              <tr>
                <td colspan=3><span style='font-weight: bold;'>Subtotal</span></td>
                <td>$total_charge</td>
              </tr>";

            $sql = "select * from address where username = '$username';";

            $user_arr = mysqli_query($connection, $sql);
            
            $user = mysqli_fetch_assoc($user_arr);

            $city = $user['city'];
            

            $transport_charge = 0; 

            switch ($city) {
                case 'Nairobi':
                    $total_charge += 50;
                    $transport_charge += 50;
                    break;

                case 'Kitengela':
                    $total_charge += 100;
                    $transport_charge += 100;
                    break;

                case 'Ongata Rongai':
                    $total_charge += 80;
                    $transport_charge += 80;
                    break;

                case 'Kiserian':
                    $total_charge += 100;
                    $transport_charge += 100;
                    break;

                case 'Kiambu':
                    $total_charge += 50;
                    $transport_charge += 50;
                    break;

                case 'Machakos':
                    $total_charge += 200;
                    $transport_charge += 200;
                    break;

                case 'Thika':
                    $total_charge += 200;
                    $transport_charge += 200;
                    break;
                
                default:
                    $total_charge += 100;
                    $transport_charge += 100;
                    break;
            }


            echo "
                <tr>
                    <td colspan=3><span style='font-weight: bold;'>Delivery Cost</span></td>
                    <td>$transport_charge</td>
               </tr>

                <tr>
                    <td colspan=3><span style='font-weight: bold;'>TOTAL</span></td>
                    <td><span style='text-decoration: underline; font-weight: bold;'>Ksh. $total_charge</span></td>
               </tr>
               
            </tbody>
        </table>
        ";

        echo "<br ><br > 

        <button class='btn btn-success'>Proceed to pay</button>";

       ?>


    </div>

      </body>
</html>