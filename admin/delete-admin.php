<?php

//include constants.php file here
include('../config/constants.php');

// 1. get the id of admin to be deleted
$id= $_GET['id'];

// 2. create sql query to delete admin
$sql = " DELETE FROM tbl_admin WHERE id = $id";

//execute the query
$res = mysqli_query($conn, $sql);

 //check whether query executed or not
 if($res==TRUE)
 {
    //query executed successfully 
    //echo "Admin deleted ";
    // create a session variable to display message
     $_SESSION['delete'] = " <div class='success'>Admin Deleted Successfully.</div>";
     //redirect to admin page
     header("location:". SIEURS.'admin/manage-admin.php');
 }
 else
 {
   // failed tp delete admin
//    echo "Failed to Delete";
   $_SESSION['delete'] = "<div class='error'> Failed to delete admin. Try again later.</div>";
   header("location:". SIEURS.'admin/manage-admin.php');
 }

//Redirect to manage admin page with message(success/error)

?>