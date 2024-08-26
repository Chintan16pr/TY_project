<?php 
    // Include Constanta File
    include('../config/constants.php');

    // echo "Delete";   
    // Check Wether the id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the Value and Delete
        // echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != "")
        {
            // Image is Available. So Remove it
            $path = "../images/category/".$image_name;
            // Remove the image
            $remove = unlink($path);

            // if failed to remove then add error message and stop the process
            if($remove == FALSE)
            {
                // Set the session message
                $_SESSION['remove'] = "<div class='error'>Faile to Remove Category Image. </div>";
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete data From Database
        // SQl Query to Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        
        // Execute the Query
        $res = mysqli_query($conn,$sql);

        // Check wether the data is deleted from database or not
        if($res == TRUE)
        {
            // Set Success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // Set Faile message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed Deleted Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        // Redirect to manage category page with message
    }
    else
    {
        // Redirect to Manage Category page
        header('location:'.SITEURL."admin/manage-category.php");
    }
?>