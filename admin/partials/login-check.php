<?php
//Authorization Access control
//check login status of user
if(!isset($_SESSION['user']))//if user session is not set 
{
//user is not logged in
$_SESSION['no-login-message'] = "<div class='error text-center'> Please login to access Admin panel.</div>";
//redirect to login page
header('location:'.SIEURS.'admin/login.php'); 

}
?>