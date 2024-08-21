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

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
    //Check Wether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        // echo "Clickd"
        // 1.Get The Data From Form
        $id = $_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password= md5($_POST['new_password']);
        $confirm_password= md5($_POST['confirm_password']);
        
        
        // 2.Check Wether the user with the usewr with Current ID and Password Exist or Not

        $sql = "SELECT * FROM tbl_admin WHERE id= $id AND password='$current_password'";

        // Execute The Query
        $res = mysqli_query($conn, $sql);
        
        if($res == TRUE)
        {
            //Check Wether Data is Available or not
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                // User Exist And Password can be Changed
                // echo "user found";
                // Check Wether the New Password and Confirm Password is Same or Not
                if($new_password == $confirm_password)
                {
                    // Update Password
                    // echo "Password Match";
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id = $id
                    ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check Wether the Query is Executed or not
                    if($res2 == TRUE)
                    {
                        // echo "Password Updated";
                        // Redirect to Manage Admin Page With Success Message
                        $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully. </div>"; 
                        //Redirdect the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        // echo "Failed to Update Password";
                        // Redirect to Manage Admin Page With Error Message
                        $_SESSION['change-pwd'] = "<div class='error'> Failed to Change the Password. </div>"; 
                        //Redirdect the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    // Redirect to Manage Admin Page With Error
                    $_SESSION['pwd-not-match'] = "<div class='error'> Password Did Not Match. </div>"; 
                    //Redirdect the User
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }
            else
            {
                //User Does not Exist Set Massage and rediret
                $_SESSION['user-not-found']="<div class='error'> User Not Found. </div>"; 

                //Redirdect the User
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        // 3.Check Wether the Current or New Password and New Password Match or Not

        /// 4. Chenge Password if all Above is True
    }
?>

<?php include('partials/footer.php'); ?>