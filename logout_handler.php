<?php 

session_start();
include_once('connection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

?>

<?php 

$username = $_SESSION['username'];

// $check_sign_out = "select * from session where username = '$username' and sign_out_time = ''";

//mysqli_query($connection, $check_sign_out);


date_default_timezone_set('Africa/Nairobi');

$sign_out_time = date('Y-m-d H:i:s', time());

$update_sql = "update session set sign_out_time = '$sign_out_time' where username = '$username' and sign_out_time = ''";


    $updated = mysqli_query($connection, $update_sql);



session_unset();

session_destroy();

header('Location: login.php');
?>