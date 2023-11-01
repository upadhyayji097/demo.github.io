<?php 
// start session
session_start();
// create constants to store non-repeating values
define('SIEURS','http://localhost/food-order/');
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "u338632248_firstdbms";


$conn = mysqli_connect($servername, $username, $password, $database)or die(mysqli_error());// database connection
$dbl_select = mysqli_select_db($conn, $database)or die(mysqli_error()); // selecting database

?>  