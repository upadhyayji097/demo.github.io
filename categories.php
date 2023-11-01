<?php
include('partials-front/menu.php');
  ?>



     <!-- CAtegories Section Starts Here -->
     <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //create sql query to display categories from database
            $sql = "SELECT * FROM tbl_category WHERE active= 'Yes' ";
            //execute the query
            $res = mysqli_query($conn, $sql);
            // count rows to check whether the categories are available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    ?>
                        
                        <a href="<?php echo SIEURS; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //check image is available or not
                            if($image_name == "")
                            {
                                //display message 
                                echo "<div class = 'error'>image not available</div>";
                            }
                            else
                            {
                                // image is available 
                                  ?>
                            <img src="<?php echo SIEURS; ?>images/category/<?php echo $image_name;  ?>" alt="Pizza" class="img-responsive img-curve" >

                                <?php
                            }

                            ?>

                            <h3 class="float-text text-white"><?php echo $title;  ?></h3>
                        </div>
                        </a>

                    <?php
                }
            }
            else
            {
                //categories not available
                echo "<div class= 'error'> Category not Added.</div>";
            }
            ?>

           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
    <?php
include('partials-front/footer.php');
  ?>