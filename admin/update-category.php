<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>


        <br><br>

        <?php 
        //check whether the id is set or not
        if(isset($_GET['id']))
        {
            //get the id and other details
            // echo "getting the data";
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows to validate 
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get all the data 
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured =$row['featured'];
                $active = $row['active'];


            }
            else
            {
                //redirect to manage category with session message
            $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
            header('location:'.SIEURS.'admin/manage-category.php');




            }
        }
        else
        {
            //redirect to manage category page
            header('location:'.SIEURS.'admin/manage-category.php');
        }
        ?>


        <form action = "" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
    <tr>
         <td>Title:</td>
         <td>  <input type = "text" name="title" value="<?php echo $title; ?> ">
         </td>
    </tr>
    <tr>
        <td>Current Image:</td>
        <td>
            <?php 
            if($current_image != "")
            {
                //display the image
                ?>
                <img src="<?php echo SIEURS; ?>images/category/<?php echo $current_image; ?>" width="100px" >

                <?php

            }
            else
            {
                // display message 
                echo "<div class='error'>Image not added.</div>";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td > New Image:</td>
        <td>
            <input type="file" name="image">
        </td>
            
        
    </tr>
    <tr>
            <td>Featured:</td>
            <td>
                <input <?php if($featured=="yes"){ echo "checked";}?> type="radio" name = "featured" value="yes" >Yes
                <input <?php if($featured=="no"){ echo "checked";}?>  type="radio" name = "featured" value="no" >No
            </td>
    </tr>
    <tr>
            <td>Active:</td>
            <td>
                <input <?php if($active=="yes"){ echo "checked";}?>  type="radio" name = "active" value="yes" >Yes

                <input <?php if($active=="no"){ echo "checked";}?>  type="radio" name = "active" value="no" >No

            </td>
        </tr>
        <tr>
            <td >
            <input type="hidden" name = "current_image" value="<?php echo $current_image; ?>" >
            <input type="hidden" name = "id" value="<?php echo $id; ?>" >

            <input type="submit" name = "submit" value="Update Category" class="btn-secondary" >

            </td>
        </tr>
</table>
</form>
<?php
if(isset($_POST['submit']))
{
    // echo "clicked";
    //get all the values from our form
     $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured =$_POST['featured'];
    $active=$_POST['active'];


    //updating new image if selected
    //check whether the image is selected or not
    if(isset($_FILES['image']['name']))
    {
        //get image details
        $image_name = $_FILES['image']['name'];

        //check whether the image is available or not
        if($image_name != "")
        {
            //image available

            //A. upload the new image
             //auto rename our image
        //get the extension of img
        $ext=end(explode('.', $image_name));
        //rename the image now
        $image_name="Food_Category_".rand(000, 999)."." .$ext;

        $source_path=$_FILES['image']['tmp_name'];

        $destination_path="../images/category/".$image_name;

        // finally upload the image
        $upload = move_uploaded_file($source_path, $destination_path);

        //check whether the image is uploaded or not
        //if image is not uploaded then we stop the process andd redirect with error message
        if($upload==false)
        {
            //set message
            $_SESSION['upload'] = "<div class = 'error'>Failed to upload image</div>";
            //redirect to add category page
            header('location:'.SIEURS.'admin/manage-category.php');
              // stop the process
             die(); 
        } 
            
            //remove the current image if available
            if($image_name != "")
            {
                $remove_path= "../images/category/".$current_image;

                $remove=unlink($remove_path);
    
                //check whether the image is removed or not
    
                //if failed to remove image the stop the process
                if($remove==false)
                {
                    //Failed to remove image
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove  current image</div>";
            header('location:'.SIEURS.'admin/manage-category.php');
            die();//stop the process  
    
                }
            }
          
        }
       

    }
    else 
    {
        $image_name = $current_image;
    }

    //update to database
    $sql2 = "UPDATE tbl_category SET 
    title = '$title' ,
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'
    WHERE id=$id

    ";
    //execute the query
    $res2 = mysqli_query($conn, $sql2);


    //redirect to manage page
    //check whether the query executed or not
    if($res2==true)
    {
        //category updated
        $_SESSION['update'] = "<div class='success'>  Category Uploaded Successfully.</div>";
        header('location:'.SIEURS.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>  Failed To Update Category.</div>";
        header('location:'.SIEURS.'admin/manage-category.php');
    }
}

?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
