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
             
        date_default_timezone_set('Africa/Nairobi');

        $sign_in_time = date('Y-m-d H:i:s', time());


        
        $username = $_SESSION['username'];
        
        $check_if_session_exists_sql = "select * from session where username = '$username' and sign_out_time = '' ";

        $session = mysqli_query($connection, $check_if_session_exists_sql);

        $num = mysqli_num_rows($session);

        if ($num < 1) {
            
         $insert_sql = "insert into session (username, sign_in_time) values('$username', '$sign_in_time')";

         $inserted = mysqli_query($connection, $insert_sql);

        }




        header('Location: index.php');
        
    } else {

        $invalid_message = "Wrong username or password!";
        header("Location: login.php?invalid_message=$invalid_message");
      
    }



    
}

?>



