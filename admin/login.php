<?php include('../config/constants.php');

?>


<html>
<head>     
<title> Login - Food Order</title>
<link rel="stylesheet" href = "../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php  
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset( $_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset( $_SESSION['no-login-message']);
        }
        ?>
        <br> <br>
        <!-- Login form starts here  -->
        <form action ="" method="post" class = "text-center">
            Username:<br>
            <input type="text" name = "username" placeholder="Enter Username" ><br><br>
            Password:<br>
            <input type="password" name = "password" placeholder="Enter password" ><br><br>
           
            <input type="submit" name = "submit" class="btn-primary" value="Login" >
            <br><br>





        </form>
        <!-- Login form Ends here  -->



        <p>Created by- <a href="">Ayush Jha</a></p>
    </div>
</body>
</html>

<?php
//check whether the button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //grt the data from login form
    // $username = $_POST['username'];
    // $password =  md5($_POST['password']);

    $username =  mysqli_real_escape_string( $conn, $_POST['username']);
     $password = md5( $_POST['password']) ;
     //  sql query to check whether the username aur password exists or not
     $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password='$password'";

     //Execute the sql query
     $res = mysqli_query($conn, $sql);

     //count rows to check whether the user exists or not
     $count = mysqli_num_rows($res);

     if($count==1)
     {
        //user available 
        $_SESSION['login'] = "<div class= 'success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unnset it
        //redirect to home page 
        header('location:'.SIEURS.'admin/'); 

     }
     else{
        //user not available
        $_SESSION['login'] = "<div class= 'error text-center'>Username or password did not match.</div>";
        //redirect to home page 
        header('location:'.SIEURS.'admin/login.php'); 

     }
}

?>