<?php include('partials/menu.php'); ?>

<div class="main-content">
<div class="wrapper">
    <h1>Change Password</h1>
    <br><br>


 <?php
  if(isset($_GET['id']))
  {
    $id = $_GET['id'];
  }


    

  ?>

    
    <form action = "" method = "post">

    <table class="tbl-30">
      <tr>
         <td>Current  password:</td>
         <td> 
             <input type = "password" name="current_password" placeholder = " Old Password"  >
         </td>
    </tr>
    <tr>
         <td>New  password:</td>
         <td> 
             <input type = "password" name="new_password" placeholder = " New Password"  >
         </td>
    </tr>
    <tr>
         <td>Confirm  password:</td>
         <td> 
             <input type = "password" name="confirm_password" placeholder = " Confirm Password"  >
         </td>
    </tr>
    <tr>
        <td colspan="2">
        <input type="hidden"  name = "id" value="<?php echo $id; ?>">
         <input type = "submit" name = "submit" value="Change password" class= "btn-secondary">
        </td>
    </tr>
</table>
</form>
      </div>
    </div>
    <?php 
//check whether the button is clicked or not
if(isset($_POST['submit']))
{
    // ECHO  "button clicked";

    //get data from the form 
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //check whether the id and password are present in database or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password ='$current_password'";

    // execute the query
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        // check whether the data is available or not
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //user exists and pass can be changed  
            // echo "user found" ;  
            if($new_password==$confirm_password)   
            {
                $sql2 = "UPDATE tbl_admin SET 
                password= '$new_password'
                WHERE id=$id
                ";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //check whether the query is executed or not
                if($res2==true)
                {

                    //display success message
                       //user does not exists set message and redirect
                       $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                       //redirect to manage admin page
                       header('location:'.SIEURS.'admin/manage-admin.php'); 

                }
                else
                {
                                  //user does not exists set message and redirect
                                  $_SESSION['change-pwd'] = "<div class='error'>Failed to change password .</div>";
                                  //redirect to manage admin page
                                  header('location:'.SIEURS.'admin/manage-admin.php'); 
                                
                            
             
                }

                
            }
            else
            {
                {
                    //user does not exists set message and redirect
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not match.</div>";
                      //redirect to manage admin page
                      header('location:'.SIEURS.'admin/manage-admin.php'); 
                    
                }

            }

        }
        else
        {
            //user does not exists set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
              //redirect to manage admin page
              header('location:'.SIEURS.'admin/manage-admin.php'); 
            
        }
    }


    
      
}

?>

<?php include('partials/footer.php'); ?> 
