<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ADMIN</h1>   
        <br/>   
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];      // Display Session Message
                unset($_SESSION['add']);    // Removing Session Message
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }


        ?>
        <br><br><br>
        <!-- Button to Add Admin -->
         <a href="add-admin.php" class="btn-primary">Add Admin</a>
        
         <br/><br/><br/>    
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
                // Query To Get ALL Admin
                $sql = "SELECT * FROM tbl_admin";
                // Execute the Query
                $res = mysqli_query($conn, $sql);

                // Check Wether The Query is Executed or Not
                if($res==TRUE)
                {
                    // Count Rows to Check Wether Data is in Database or not
                    $count = mysqli_num_rows($res);  //Function to get all the rows in database

                    $sn = 1;    // Create a Variable And Assign Value
                    // Check The Number of rows 
                    if($count>0)
                    {
                        // WE have Data in Database
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            // Using While loop to Get ALL Data from Database
                            // And while loop will run as long as we have data in database

                            // Get Individual Data
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            // Display All The Value in Table
                        ?>
                        <tr>
                            <td><?php echo $sn++ ?>.</td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                            <a href="<?php echo SITEURL ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
                        <?php
                        }
                    }
                    else{
                        // We do Not Have Data in Database
                    }
                }
            ?>
        </table>
    </div>
</div>
        
<?php include('partials/footer.php') ?>
