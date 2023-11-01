<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo  $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form method="POST"  enctype="multipart/form-data">
        <table class="tbl-30">
      <tr>
        <td>Title:</td>
        <td>
            <input type="text" name="title"  placeholder="Title of the food" > 
        </td>
      </tr>
      <tr>
        <td>Description:</td>
        <td>
            <textarea name="description" cols="30" rows="5" placeholder="description of the food" ></textarea>
        </td>
      </tr>
      <tr>
        <td>Price:</td>
        <td>
            <input type="number" name="price"> 
        </td>
      </tr>
      <tr>
        <td>Select Image:</td>
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
                        $id = $row['id'];
                        $title =$row['title'];
                        ?>
                          <option value="<?php echo $id; ?>" ><?php echo $title; ?></option> 

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
                ///display on dropdown
                 ?>   

            </select>
        </td>
      </tr>
      <tr>
            <td>Featured:</td>
            <td>
                <input type="radio" name = "featured" value="yes" >Yes
                <input type="radio" name = "featured" value="no" >No
            </td>
        </tr>
        <tr>
            <td>Active:</td>
            <td>
                <input type="radio" name = "active" value="yes" >Yes
                <input type="radio" name = "active" value="no" >No

            </td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="submit" name = "submit" value="Add Food" class = "btn-secondary" >


            </td>
           
        </tr>


        </table>


        </form>

        <?php
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the food inn database
            // echo "clicked";

            //get the data from the form 
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether the button for featured is checked or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];

            }
            else
            {
                $featured="no";//the default value
            }
             if(isset($_POST['active']))
            {
                $active = $_POST['active'];

            }
            else{
                $active="no";//the default value
            }


            //upload the image if selected
            if(isset($_FILES['image']['name']))
            {
              //get the details of image
              $image_name=$_FILES['image']['name'];

            //check whether the image is selected or not
            if($image_name != "")
            {
                //image is selected 
                // Rename the image
                //get the extension of the selected image
                $ext =  end(explode('.', $image_name)); 

                //create new name for image
                $image_name= "Food-name-".rand(0000,99999).".".$ext;

                //upload tje image
                //get the src path and destination path
                $src=$_FILES['image']['tmp_name'];

                //destination path
                $dst = "../images/food/".$image_name;

                //finally upload the file
                $upload= move_uploaded_file($src, $dst);

                //check whether the image is uploaded or not
                if($upload==false)

                {
                    //failed to upload the image
                    //redirect to add food with error message
                    $_SESSION['upload']= "<div class='error'>Failed to upload the image</div>";
                     header('location:'.SIEURS.'admin/add-food.php');

                    //stop the process
                    die();
                }

            }



            }
            else{
                $image_name="";//the default value as blank
            } 



            
            // insert into the database 
            $sql2 = "INSERT INTO tbl_food SET
            title ='$title',
            description = '$description',
            price = $price, #for numeric value we don't need to write it in cotes
            image_name = '$image_name',
            category_id = $category,
            featured= '$featured',
            active ='$active'

             ";

             //execute the query
             $res2 = mysqli_query($conn, $sql2);
             //check whether the data is inserted or not
             if($res2==true)
             {
                //data inserted successfully
                     $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                     header('location:'.SIEURS.'admin/manage-food.php');

             }
             else 
             {
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:'.SIEURS.'admin/manage-food.php');


             }


        }

        ?>
    </div>
</div>




<?php include('partials/footer.php'); ?>
