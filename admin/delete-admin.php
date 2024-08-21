<?php

    // Include constants.php here
    include('../config/constants.php');

    // 1. Get the Id of Admin to be Deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check Wether The query Executed Successfully or Not
    if($res==TRUE)
    {
        //Query Executed Successfully and Admin Deleted
        // echo "Admin Deleted Successfully";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        // Redirect To Manage Admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Delete Admin
        // echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    // 3. Redirect to Manage admin page with message (Success/Error)

?>