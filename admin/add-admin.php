<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);    
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" placeholder="Your Name"></td>
            </tr>
            <tr>
                <td>Username :</td>
                <td><input type="text" name="username" placeholder="Your Username"></td>
            </tr>
            <tr>
                <td>Password :</td>
                <td><input type="password" name="password" placeholder="Your Password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php
    // Process The Value From Form and Save it in Database
    
    // Check Whether The Submit Button is Clicked or Not
    
    if(isset($_POST['submit']))
    {
        // Button clicked
        // echo "Button Clicked";
        
        //1. Get The Data From Form
        $full_name = $_POST['full_name']; 
        $username = $_POST['username']; 
        $password = md5($_POST['password']); // password Encryption with MD5

        // 2. Sql Query to Save the Data into Database
         $sql = "INSERT INTO tbl_admin SET
         full_name = '$full_name',
         username = '$username',
         password='$password'
         ";

        // 3. Execute Query and save data in Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Check Wethere The Data is Inserted or not and Display Appropriate Message
        if($res==TRUE)
        {
            // Data Inserted
            // echo "data inserted";
            // Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            // Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            // Failed to Insert Data
            // echo "failed to insert data";
            $_SESSION['add'] = "<div class='error'>Failedn to Add Admin</div>";
            // Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>