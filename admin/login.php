<?php 
    include('../config/constants.php');
?>

<html>
        <head>
            <title>Login - Food Order System</title>
            <link rel="stylesheet" href="../css/index.css">
        </head>
        <Body>
            <div class="login">
                <h1 class="text-center">Admin Login</h1>
                <br><br>

                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }

                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }


                ?>
                <br><br>

                <!-- Login Form Start Here -->
                <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="submit" value="Submit" class="btn-primary"><br><br>
                </form> 
                <!-- Login Form Ends Here -->

                <p class="text-center">Created by - <a href="#">Chintan Prajapati</a> & <a href="#">Shrey Nayak</a></p>

            </div>
            
        </Body>
</html>

<?php

    // Check Wether The Submit Button is Clicked or Not
    if(isset($_POST['submit']))
    {
        // Process for Login
        // 1.Get the Data From Login Form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // 2.SQL to Check Wether the username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        // 3.Execute the Query
        $res = mysqli_query($conn, $sql);

        // 4.Counts rows to Check wether the User Exists or Not
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // User Available and Login Success
            $_SESSION['login'] = "<div class='success text-center'> Login Successfull .</div>";
            $_SESSION['user'] = $username;//To Check Wether the User is Loggedin Or Not and Logout Will Unset it
            // Redrect to Home/Dashbord
            header('location:'.SITEURL.'admin');
        }
        else
        {
            // User Not Available and login Fail
            $_SESSION['login'] = "<div class='error text-center'> Username or Password Did Not Match .</div>";
            // Redrect to Home/Dashbord
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>