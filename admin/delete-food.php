<?php 

    // Including Constants
    include('../config/constants.php');

    // echo "Delete Food Page";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // Process to delete
        // echo "Process To Delete.";

        // 1. Get ID and Image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2. Remove the Image if Available
        // Check Wether the  Image is Available
        if($image_name != "")
        {
            // Hase Image
            // Get Image Pass 
            $path = "../images/food/".$image_name;

            // Remove Image File From Folder
            $remove = unlink($path);

            // Check Wether the Image is Removed or not
            if($remove==false)
            {
                // Failed to Remove Image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                // REdirect to Manage Food
                header("location:".SITEURL."admin/manage-food.php");
                // Stop the Process of Deleting Food
                die();
            }
        }
       

        // 3. Delete Food From DataBase
        $sql = "DELETE FROM tbl_food WHERE id = $id";
        // Execute the Query
        $res = mysqli_query($conn,$sql);

        // Check Wether The Executed Or Not

        // 4.Redirect to Mamage Food With Session Message
        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
        
    }
    else
    {
        // Redirect to Manage Food Page
        // echo "Redirect";
        $_SESSION['unauthorized'] = "<dov class='error'>Unauthorized Access.</div>";
        header("location:".SITEURL."admin/manage-food.php");
    }
?>