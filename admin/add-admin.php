
<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br><br>
        <?php 
                 if(isset($_SESSION['add']))
                 {
                  // displaying session message
                  echo $_SESSION['add'];
                  // removing session message
                  unset($_SESSION['add']); 
                 }
        ?>

        <form method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type = "text" name = "full_name" placeholder= "Enter your full name"></td> 


               
            </tr>
            <tr>
     <td> Username: </td>
     <td>
     <input type =" text"name ="username" placeholder = " Your Username " >
     </td>
</tr>
<tr>
     <td> Password:  </td>
     <td><input type="password"name="password" placeholder = " Your Password "> </td>
      </tr>
      <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="ADD ADMIN" class="btn-secondary">
        </td>
      </tr>
            
            </table>
        </form>
    </div>
</div>



<?php include('partials/footer.php'); ?>

<?php
// process the value form and save it in database
// Check whether submit button is clicked or not
if(isset($_POST['submit'])){
    
    // get the data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
//    sql query to save the data into database
$sql = "INSERT INTO tbl_admin SET
full_name='$full_name',
username = '$username',
password = '$password'

";
// Execute Query and save in database

$res = mysqli_query($conn, $sql)or die(mysqli_error());
// check whether the (query is executed) data  is inserted or not and display appropriate message

if($res==TRUE)
{
    //data is inserted
    // echo "data is inserted";
    // create a session variable to display message
    $_SESSION['add'] = "Admin Added Successfully";
    // redirect page to manage admin
    header("location:". SIEURS.'admin/manage-admin.php' );
}
else{
    // Failed to insert data
    // echo "data is not inserted";
     // create a session variable to display message
     $_SESSION['add'] = "Failed To Add Admin";
     // redirect page to manage admin
     header('location:'.SIEURS.'admin/manage-admin.php'); 
    
}
}


?>