<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        // Get the id of Selected Admin
        $id = $_GET['id'];

        // Create Sql Query to Get The Details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn,$sql);

        // Check Wether the Query is Executed or not
        if($res==TRUE)
        {
            // Check Wether the Data is Available or not
            $count = mysqli_num_rows($res);
            // Check wether we have Admin Data or not
            if($count == 1)
            {
                //Get The Details
                // echo "admin Available";
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            }
            else
            {
                //Redirect to Manage Admin Page
                header('location:'.$SITEURL.'manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
            </tr>
            <tr>
                <td>Username :</td>
                <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
</div>

<?php 

    // Check wether the Button is Clicked or not
    if(isset($_POST['submit']))
    {
        // echo " Button Clicked ";
        // Get all the Value From Form to Update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        ///Create Sql Query to Update Admin

        $sql =  "UPDATE tbl_admin SET 
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
        ";

        // Execute the Query
        $res = mysqli_query($conn, $sql);

        // Check Wether the Query is Executed or not
        if($res == TRUE)
        {
            //Query Executed And Admin Updated Successfully
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            //Redirect to Manage Admin Page
            header("location:".SITEURL."admin/manage-admin.php");
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin</div>";
            //Redirect to Manage Admin Page
            header("location:".SITEURL."admin/manage-admin.php");
        }

    }

?>

<?php include('partials/footer.php') ?>