<?php
include('partials-front/menu.php');

?>

<?php
//check whether id is passed or not
if(isset($_GET['food_id']))
{
    //category is set and get the id 
    $food_id = $_GET['food_id'];
    //get the category title based on id
    $sql =" SELECT * FROM tbl_food WHERE id=$food_id "; 

    // Execute the query
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);
    //check whether the data is available or not
    if($count==1)
    {
        //we have data
        //get the data from the database
        $row =mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];

    }
    else
    {
        //food not available 
        //redirect to home page
         header('location:'.SIEURS);

    }
}
else
{
    //category not passed 
    //redirect to home page
    header('location:'.SIEURS);


}

?> <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        // check whether the image is available or not
                        if($image_name == "")
                        {
                            //image not available
                            echo "<div class='error'> Image not Available</div>.";
                        }
                        else 
                        {
                            //image available
                            ?>
                        <img src="<?php echo SIEURS; ?>images/food/<?php echo $image_name;?>" alt=" Pizza" class="img-responsive img-curve">


                            <?php
                        }

                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3> <?php echo $title; ?></h3>

                        <input type="hidden" name="food" value="<?php echo $title;?>" >
                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>" >
                        

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Abhi Upadhyay" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="phone" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. abc@.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php

            //check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //get all the details from the form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $order_date= date("Y-m-d h:i:sa");//order date
                $status = "Ordered";
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //save the order in the database
                //create sql to save data
                $sql2 = "INSERT INTO tbl_order SET
                  food = '$food',
                  price ='$price',
                  qty = '$qty',
                  total ='$total',
                  order_date='$order_date',
                  status = '$status',
                  customer_name='$customer_name',
                  coustomer_contact='$customer_contact',
                  coustomer_email='$customer_email',
                  coustomer_address='$customer_address'
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether the query executed or not
                if($res2==true)
                {
                    //query executed and order saved 
                    $_SESSION['order'] = "<div class='text-success text-center' style='color:white; background-color:green;' >Food Ordered Successfully.</div>";
                    //redirect to home page
                    header('location:'.SIEURS);

                }
                else 
                {
                    //failed to save order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                    //redirect to home page
                    header('location:'.SIEURS);
                }


            }
            

            ?>

            

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
include('partials-front/footer.php');

?>