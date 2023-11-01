<?php 
// start session
session_start();
// create constants to store non-repeating values
define('SIEURS','http://localhost/food-order/');
define('LOCALHOST','localhost' );
define('DB_USERNAME','abhishek1' );
define('DB_PASSWORD','Desipan@1351' );
define('DB_NAME','u338632248_foodorder1' );

$conn = mysqli_connect(LOCALHOST , DB_USERNAME, DB_PASSWORD)or die(mysqli_error());// database connection
$dbl_select = mysqli_select_db($conn, DB_NAME)or die(mysqli_error()); // selecting database

?>