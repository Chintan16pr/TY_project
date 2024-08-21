<?php 
    // Include Constanta File
    include('../config/constants.php');

    // echo "Delete";
    // Check Wether the id and image_name is set or not
    if(isset($_GET['id'] ANd isset($_GET['image_name'])))
    {
        // Get the Value and Delete
    }
    else
    {
        // Redirect to Manage Category page
        header('location:'.SITEURL."admin/manage-category.php");
    }
?>