<?php
include('partials-front/menu.php');



   ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SIEURS; ?>food-search.php " method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php

    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset ($_SESSION['order']);
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //create sql query to display categories from database
            $sql = "SELECT * FROM tbl_category WHERE active= 'Yes' AND featured = 'Yes' LIMIT 3";
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
                        
                        <a href="<?php echo SIEURS; ?>category-foods.php?category_id=<?php echo $id ?> ">
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
                            <img src="<?php echo SIEURS; ?>images/category/<?php echo $image_name;  ?>" alt="Pizza" class="img-responsive img-curve" width="100px">

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

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //getting food from the database that are active and featured
                $sql2 = "SELECT * FROM tbl_food WHERE active= 'Yes' AND featured = 'Yes' LIMIT 6";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                // count rows to check whether the categories are available or not
                $count2 = mysqli_num_rows($res2);
    
                if($count2>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>

                                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //check image is available or not
                            if($image_name == "")
                            {
                                //display message 
                                echo "<div class = 'error'>Image not available</div>";
                            }
                            else
                            {
                                // image is available 
                                  ?>
                            <img src="<?php echo SIEURS; ?>images/food/<?php echo $image_name;  ?>" alt="Pizza" class="img-responsive img-curve" width="100px">

                                <?php
                            }

                            ?>


                        </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?></p>
                                <p class="food-detail">
                                <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php echo SIEURS;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                    </div>

                        <?php

                    }
                    
                } 
                else
                {
                    //Food not available
                    echo "<div class= 'error'> Food Not Available.</div>";
                }   
    

            ?>




            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php
include('partials-front/footer.php');



   ?>