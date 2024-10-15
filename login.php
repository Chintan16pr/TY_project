<?php include("partials-front/menu.php"); ?>
<html>
        <head>
            <title>Login - Food Order System</title>
        </head>
        <Body>
            <div class="login">
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
                <form action="" method="POST" class="text-center login-container">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <!-- <input type="submit" name="submit" value="Submit"><br><br> -->
                <button type="submit" name="submit" value="Submit">Login</button>
                </form> 
                <!-- Login Form Ends Here -->
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
        $sql = "INSERT INTO tbl_login SET
         username = '$username',
         password ='$password'
         ";

        // 3.Execute the Query
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['login'] = "<div class='success text-center'> Login Successfull .</div>";
            header('location:'.SITEURL.'index.php');
        }
    }
?>
<?php include("partials-front/footer.php"); ?>