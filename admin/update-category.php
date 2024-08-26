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
                        <input type="submit" name="submit" value="update-category" class="btn-secondary"> 
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php');?>