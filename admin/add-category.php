<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        
        <br><br>
        
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset( $_SESSION['upload']);
            }
        ?>

        <br><br>

        <!--  Add Category Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>

                <tr>
                    <td>
                        Select Image:
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>
        <!--  Add Category Ends -->

        <?php 
            // Check Wether the Submit is Clicked or Not
            if(isset($_POST['submit']))
            {
            // echo " Is Clicked";

            // 1. get the value from category form
            $title = $_POST['title'];

            // for radio input we need to check wether selected or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No";
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            // check wehter image is  selected or not and set the value for image name accoridingly
            // print_r($_FILES['image']);
            // die(); // Break the code here

            if(isset($_FILES['image']['name']))
            {
                // upload the image
                // to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                // Upload the image only if image is selected
                if($image_name != "")
                {

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
                }
            }
            else
            {
                // dont upload the image
                $image_name = "";
            }

            // 2. create sql query to insert category in database

            $sql = "INSERT INTO tbl_category SET 
                   title  = '$title',
                   image_name='$image_name',
                   featured = '$featured',
                   active = '$active'
                   ";

            // 3. Execute the query and save it in database
            $res = mysqli_query($conn, $sql);

            // 4. check wehter the query executed or not and data inserted or not
            if($res==TRUE)
            {
                // query executed and data inserted 
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                //redirect to Manage Category Page
                header("location:".SITEURL.'admin/manage-category.php');
            }
            else
            {
                // failed to add data
                $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                //redirect to menu
                header("location:".SITEURL.'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>