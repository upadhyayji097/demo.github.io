
<?php
include('../config/constants.php');

// echo "Delete page";
//check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete
    // echo "get value and delete";
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //remove the physical image
    if($image_name !="")
    {
        //image is available so delete it
        $path ="../images/category/".$image_name;
        //remove the image
        $remove= unlink($path);
        //if fail to remove image then add an error message


        if($remove==false)
        {
            //set the session message
            $_SESSION['remove']= "<div class='error'>Failed to remove image.</div>";

            //redirect to manage category page
            header('location:'.SIEURS.'admin/manage-category.php' );

            //stop the process
            die();


        }
    }

    //delete from database
    //sql query to delete database 
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //execute the query
    $res=mysqli_query($conn, $sql);
    //check whether the data is deleted from database or not
    if($res==true)
    {
        // set success message and redirect 
        $_SESSION['delete']= "<div class='success'>Category Deleted Successfully.</div>";
        //redirect to manage category page
    header('location:'.SIEURS.'admin/manage-category.php');



    }
    else
    {
       // set failure message and redirect 
       $_SESSION['delete']= "<div class='Error'Failed to  Delete> Category .</div>";
       //redirect to manage category page
   header('location:'.SIEURS.'admin/manage-category.php');  
    }

}
else{
    // redirect to page 
    header('location:'.SIEURS.'admin/manage-category.php');

}
 ?>