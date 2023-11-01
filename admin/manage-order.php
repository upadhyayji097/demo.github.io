<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper"> 
        <h1>Manage Order</h1>


        <br><br><br>

                 
                 
              
                 <?php
                  if(isset($_SESSION['update']))
                  {
                     echo $_SESSION['update'];
                     unset(  $_SESSION['update']);
                  }

                  ?>
                  <br> <br>
                
                 

                 <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Price</th>
                        <th>qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //get all the orders from database
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                    //execute query
                    $res = mysqli_query($conn, $sql);
                    //count the rows
                    $count = mysqli_num_rows($res);
                    $sn=1;//create a serial number 

                    if($count>0)
                  {
                     //order available 
                     while($row=mysqli_fetch_assoc($res))
                     {
                        //get all the order details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $coustomer_contact = $row['coustomer_contact'];
                        $coustomer_email = $row['coustomer_email'];
                        $coustomer_address = $row['coustomer_address'];

                        ?>
                           <tr>
                                 <td><?php echo $sn++; ?></td>
                                 <td><?php echo $food; ?></td>
                                 <td><?php echo $price; ?></td>
                                 <td><?php echo $qty; ?></td>
                                 <td><?php echo $total; ?></td>
                                  <td><?php echo $order_date; ?></td>

                                 <td>
                                    <?php 
                                    //ordered on delivery delivered cancelled

                                    if($status=="Ordered")
                                    {
                                       echo "<label >$status </label>";
                                    }
                                    elseif($status=="On Delivery")
                                    {
                                    
                                       echo "<label style='color: orange;' >$status </label>";


                                    }
                                    elseif($status=="Delivered")
                                    {
                                    
                                       echo "<label style='color:green;' >$status </label>";


                                    }
                                    elseif($status=="Cancelled")
                                    {
                                    
                                       echo "<label style='color: red;' >$status </label>";


                                    }
                                    ?>
                                 </td>

                                 <td><?php echo $customer_name; ?></td>
                                 <td><?php echo $coustomer_contact; ?></td>
                                 <td><?php echo $coustomer_email; ?></td>
                                 <td><?php echo $coustomer_address; ?></td>

                                 <td>
                                 <a href="<?php echo SIEURS;?>admin/update-order.php?id=<?php echo $id; ?> " class="btn-secondary" >Update Order </a>
                                 </td>
                           </tr>
                           
                        <?php
                     }
                  }
                    
               else
               {
                     //order not available
                     echo "<tr> <td colspan = '12' class='error'>Orders not available </td></tr>";
                }
  ?>
             
               
                 </table>
                </div>
    
                   </div>

<?php include('partials/footer.php'); ?>