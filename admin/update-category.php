<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 
            // Check Wether the id is set or not
            if(isset($_GET['id']))
            {
                // Get the id and all other details
                // echo "Geting Data";
                $id = $_GET['id'];
                // Create sql Query to Get All the Other Details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                // Execute the Query
                $res = mysqli_query($conn , $sql);

                // Count the Rows to Check Wether the ID id Valid or Not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // Get all the Data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    // Redirect to Manage Category With Message
                    $_SESSION['no-category-found'] = "<div class='error'> Category Not Found. </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                // Redirect to Manage Category
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                // Display the Image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                // Display the Message
                                echo "<div class='error'> Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update-category" class="btn-secondary"> 
                    </td>
                </tr>

            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                // echo "Clicked";
                // 1. Get All the Value from our Form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2. Updating New Image if Selected
                // Check Wether the Image is Selected or Not
                if(isset($_FILES['image']['name']))
                {
                    // Get the Image Details
                    $image_name = $_FILES['image']['name'];

                    // Check Wether the Image is Available or Not
                    if($image_name != "")
                    {
                        // Image Available

                        // A. Upload the New Image
                        
                        // Auto Rename our Image
                        // Get the Extention of our image (jpg, png , gif ,etc)
                        $ext = end(explode('.' , $image_name));

                        // Rename the Image
                        $image_name = "Food_category_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // Finally Upload the Image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        // Check Wether the Image is Uploaded or Not 
                        // And if Image is Not Uploaded then we will Stop the Process and Redirect With Error Message
                        if($upload == false)
                        {
                            // Set Message
                            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image</div>";
                            // Redirect to Add Category Page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            // Stop the Process
                            die();
                        }
                        
                        // B. Remove the Current Image if available
                        if($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image; 
                            
                            $remove = unlink($remove_path);
                            
                            // Check Wether the Image is Removed or Not
                            // If Failed to Remove then Display Message and Stop the Process
                            if($remove == false)
                            {
                                // Failed to Remove Image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove the Current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();// Stop The Process
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // 3. Update the Database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                // Execute the Query
                $res2 = mysqli_query($conn,$sql2);

                // 4. Redirect to Manage category With Message
                // Check Wether Query Executed or Not
                if($res2 == true)
                {
                    // Category Updated
                    $_SESSION['update'] = "<div class='success'> Category Updated Successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // Failed to Update Category
                    $_SESSION['update'] = "<div class='error'> Failed to Update Category. </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php');?>