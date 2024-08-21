
<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        
        <br><br><br>
        
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <br><br><br>

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
                        <input type="radio" name="active" name="Yes"> Yes
                        <input type="radio" name="active" name="No"> No
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
                #echo " Is Clicked";

                #1. get the value from category form

                $title = $_POST['title'];

                #2. for radio input we need to check wether selected or not
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

            #check wehter image is  selected or not
            // print_r($_FILES['image']);

            // die();

            if(isset($_FILES['images']['name']))
            {
                    #upload the image
                    $image_name = $_FILES['image']['name'];
                    $source_path = $_FILES['image']['name'];
                    $destination_path = "";

            }
            else
            {
                    #dont upload the image

                    $image_name = "";


            }

            #2. create sql query to insert category in database

            $sql = "INSERT INTO tbl_category SET 
                   title  = '$title',
                   featured = '$featured',
                   active = '$active'

            ";
                #3. Execute the query and save it in database

                $res = mysqli_query($conn, $sql);

                #4. check wehter the query executed or not and data inserted or not

                if($res==TRUE)
                {
                    # query executed and data inserted 
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //redirect to menu
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else
                {
                    # failed to add data
                    $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                    //redirect to menu
                    header("location:".SITEURL.'admin/add-category.php');
                }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
