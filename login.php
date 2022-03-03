<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed">
      <div class="container-fluid">

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
        <div class="collapse navbar-collapse" id="mynavbar">
        </div>
      </div>
    </nav>

    <!--Forms-->
    <div class="container" style="margin-top: 80px">
      <div class="row">
        <!-- Login here -->
        <div class="col-md-6 ">
          <h2>Login here</h2>
          <?php 

          

          if (isset($_GET['invalid_message'])) {
            $invalid_message = $_GET['invalid_message'];
 
            $invalid_message = "Wrong username or password!";
            echo "<p class='text-danger'>$invalid_message</p>";
          }
          
          ?>
          
          <form action="login_handler.php" class='bg-light border p-3' method="post">
            <div class="form-group">
              <input
                type="text"
                name="username"
                class="form-control"
                placeholder="username"
                required
              />
            </div>
            <br /><br />
            <div class="form-group">
              <input
                type="password"
                name="password"
                class="form-control"
                placeholder="password"
                required
              />
            </div>
            <br /><br />
            <input
              class="btn btn-primary"
              type="submit"
              name="login"
              value="Login"
            />
          </form>
        </div>

        <!--Register here-->
        <div class="col-md-6 register">
          <h2>Register here</h2>
          <?php


          if (isset($_GET['message'])) {

            $message = $_GET['message'];
            $message = "Username already exists!";
            echo "<p class='text-danger'>$message</p>";
            
          }
           

          ?>

          <form
          class='bg-light border p-3'
            name="myForm"
            action="register_handler.php"
            method="post"
            onsubmit="return validateForm()"
          >
            <div class="form-group">
              <input
                type="text"
                id="username"
                name="username"
                class="form-control"
                placeholder="username"
                required
              />
            </div>
            <br /><br />

            <div class="form-group">
              <input
                type="email"
                name="email"
                class="form-control"
                placeholder="email"
                required
              />
            </div>
            <br /><br />

            <div class="form-group">
              <input
                id="password"
                type="password"
                name="password"
                class="form-control"
                placeholder="password"
                required
              />
            </div>
            <br /><br />
            <input
              type="submit"
              class="btn btn-primary"
              name="register"
              value="Register"
            />
          </form>

          
        </div>
      </div>
    </div>
    <p id="demo"></p>

    <script>
      function validateForm() {
        let username = document.myForm.username.value;
        let password = document.myForm.password.value;

        if (username == null || username == "") {
          alert("Username can't be blank!");
          return false;
        } else if (password.length < 6) {
          alert("Password must be at least 6 characters long!");
          return false;
        }
      }
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
