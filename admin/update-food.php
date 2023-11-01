<?php include('partials/menu.php'); ?>


<?php 
        //check whether the id is set or not
        if(isset($_GET['id']))
        {
            //get the id and other details
            // echo "getting the data";
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

                //get the value based on query
                $row2 = mysqli_fetch_assoc($res2);

          
         
            
                //get the individual data 
                $title = $row2['title'];
                $description= $row2['description'];
                $price= $row2['price'];
                $current_image= $row2['image_name'];
                $current_category= $row2['category_id'];
                $featured =$row2['featured'];
                $active = $row2['active'];
            
        }
        else
        {
            //redirect to manage category page
            header('location:'.SIEURS.'admin/manage-food.php');
        }
        ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

       

        <form method="POST"  enctype="multipart/form-data">
        <table class="tbl-30">
      <tr>
        <td>Title:</td>
        <td>
            <input type="text" name="title"  value ="<?php echo $title; ?> "> 
        </td>
      </tr>
      <tr>
        <td>Description:</td>
        <td>
            <textarea name="description" cols="30" rows="5" ><?php echo $description;?></textarea>
        </td>
      </tr>
      <tr>
        <td>Price:</td>
        <td>
            <input type="number" name="price" value="<?php echo $price;?>"> 
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
                <img src="<?php echo SIEURS; ?>images/food/<?php echo $current_image; ?>" width="100px" >

                <?php

            }
            else
            {
                // display message 
                echo "<div class='error'>Image not available.</div>";
            }
            ?>

        </td>
      </tr>
      <tr>
        <td>Select New Image:</td>
        <td>
            <input type="file" name="image"   > 

        </td>
      </tr>

      <tr>
        <td>Category:</td>
        <td>
            <select name="category" id="">

                <?php 
                //create php code to display categories from database
                //create a sql query to get all activate categories

                $sql  = "SELECT * FROM tbl_category WHERE active='yes'";
                //executing the query
                $res = mysqli_query($conn, $sql);


                //whether we have categories or not
                $count  = mysqli_num_rows($res);

                //if $count is greater than 0 than we have categories 
                if($count>0)
                {
                    //we have categories
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the details of the category
                        $category_title = $row['title'];
                        $category_id =$row['id'];
                        
                        //  echo "<option value '$category_id'>$category_title</option> ";
                        ?>
                          <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id; ?>" ><?php echo $category_title; ?></option> 

                        <?php

                        
                    }
                }
                else
                {
                    //we don't have categories  
                    ?>
                       <option value="0" >No Category found</option>

                    <?php
                }
                //display on dropdown
                 ?>   

            </select>
        </td>
      </tr>
      <tr>
            <td>Featured:</td>
            <td>
                <input <?php if($featured=="Yes"){ echo "checked";}?><?php  echo $featured;?> type="radio" name = "featured" value="yes" >Yes
                <input <?php if($featured=="No"){ echo "checked";}?><?php  echo $featured;?>   type="radio" name = "featured" value="no" >No
            </td>
        </tr>
        <tr>
            <td>Active:</td>
            <td>
                <input <?php if($active=="Yes"){ echo "checked";}?><?php  echo $active;?>  type="radio" name = "active" value="yes" >Yes
                <input <?php if($active=="No"){ echo "checked";}?> <?php  echo $active;?>  type="radio" name = "active" value="no" >No
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="hidden" name = "id" value="<?php echo $id; ?>" >
            <input type="hidden" name = "current_image" value="<?php echo $current_image; ?>" >

            <input type="submit" name = "submit" value="Update Food" class = "btn-secondary" >


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
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured =$_POST['featured'];
                    $active=$_POST['active'];


                    //updating new image if selected
                    //check whether the image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get image details
                        $image_name = $_FILES['image']['name'];//new image

                        //check whether the image is available or not
                        if($image_name != "")
                        {
                            //image available

                            //A. upload the new image
                            //auto rename our image
                        //get the extension of img
                        $ext=end(explode('.', $image_name));
                        //rename the image now
                        $image_name="Food_name_".rand(0000, 9999)."." .$ext;

                        //get the source path

                        $src_path=$_FILES['image']['tmp_name'];

                        $dst_path="../images/food/".$image_name;

                        // finally upload the image
                        $upload = move_uploaded_file($src_path, $dst_path);

                        //check whether the image is uploaded or not
                        //if image is not uploaded then we stop the process andd redirect with error message
                        if($upload==false)
                        {
                            //set message
                            $_SESSION['upload'] = "<div class = 'error'>Failed to upload New image</div>";
                            //redirect to add category page
                            header('location:'.SIEURS.'admin/manage-food.php');
                            // stop the process
                            die(); 
                        } 
                        // else
                        // {
                        // $image_name = $current_image;

                        // }
                            
                            //remove the current image if available
                            if($current_image != "")
                            {
                                $remove_path= "../images/food/".$current_image;

                                $remove=unlink($remove_path);
                    
                                // check whether the image is removed or not
                    
                                // if failed to remove image the stop the process
                                if($remove==false)
                                {
                                    //Failed to remove image
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to remove  current image</div>";
                            header('location:'.SIEURS.'admin/manage-food.php');
                            die();//stop the process  
                    
                                }
                            }
                        
                        }
                        else
                        {
                        $image_name = $current_image;

                        }
                    
                    }
                    else 
                    {
                        $image_name = $current_image;
                    }

                    //update to database
                    $sql3 = "UPDATE tbl_food SET 
                    title = '$title' ,
                    description='$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id='$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id

                    ";
                    //execute the query
                    $res3 = mysqli_query($conn, $sql3);


                    //redirect to manage page
                    //check whether the query executed or not
                    if($res3==true)
                    {
                        //category updated
                        $_SESSION['update'] = "<div class='success'>  Food Updated Successfully.</div>";
                        header('location:'.SIEURS.'admin/manage-food.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>  Failed To Update Food.</div>";
                        header('location:'.SIEURS.'admin/manage-food.php');
                    }
                }

?>

     
    </div>
</div>




<?php include('partials/footer.php'); ?>
