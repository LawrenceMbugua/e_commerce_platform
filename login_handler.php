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

    $_SESSION['username'] = $username;

    if ($row == 1) {
        
        header('Location: index.php');
      
    } else {
        header('Location: login.html');
      
    }



    
}

?>



