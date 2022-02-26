<?php 

session_start();
include_once('connection.php');


?>

<?php

if (isset($_POST['login'])) {
    

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from users where username = '$username' and password = '$password'";

    $user = mysqli_query($connection, $sql);

    $row = mysqli_num_rows($user);

    //Check if user exists
    if ($row == 1) {
        
        $_SESSION['username'] = $username;

        header('Location: index.php');
        
    } else {

        $invalid_message = "Wrong username or password!";
        header("Location: login.php?invalid_message=$invalid_message");
      
    }



    
}

?>



