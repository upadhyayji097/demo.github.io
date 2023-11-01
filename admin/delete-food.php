<?php
//include constants page
include('../config/constants.php');
// echo "Delete food";
//check whether the value is passed or not 
if(isset($_GET['id'])&&  isset($_GET['image_name'])) //&& == to AND.
{
    //process to delete 
    // echo "Process to delete";

    //get id and image name
    $id= $_GET['id'];
    $image_name = $_GET['image_name'];


    //remove the image if available
      // check whether the image id available or not
      if($image_name != "")
      {
        //image is available and we delete image
        $path = "../images/food/".$image_name;

        //remove img from folder
        $remove = unlink($path);

        //check whether the 9image is removed or not
        if($remove==false)
        {
            //failed to remove image
            $_SESSION['upload'] = "<div class='error'> Failed to remove image file</div>";

               //redirect to manage food page
 
             header('location:'.SIEURS.'admin/manage-food.php' );
             //stop the process
             die();

        }
      }

    //delete food from database 
    $sql= "DELETE  FROM tbl_food WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether query executed or not
    //redirect to manage food page with session message

    if($res==true)
    {
        //food deleted
        $_SESSION['delete']= "<div class='success'>Food Deleted Successfully</div>";
         header('location:'.SIEURS.'admin/manage-food.php');

    }
    else
    {
        //failed to delete food
        $_SESSION['delete']= "<div class='error'>Failed to delete food</div>";
        header('location:'.SIEURS.'admin/manage-food.php' );
    }


}
else
{
    //redirect to manage food page
    // echo "redirect";
    $_SESSION['unauthorized'] = "<div class ='error'> Unauthorized Access</div>";
    header('location:'.SIEURS. 'admin/manage-food.php' );
}

?>
