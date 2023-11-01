<?php
//include constants .php file here
 include('../config/constants.php');

// destroy the session
session_destroy();//unset $_session 



// redirect to login page
// header('location:'.SIEURS.'admin/login.php'); 
header('location:'.SIEURS); 


?>