<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SERVER['upload']);
            }
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title Of The Food"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description Of The Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                // Create PHP to Display Category From Database
                                // 1. Create SQL Query to get all active Categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                // Execute Query
                                $res = mysqli_query($conn,$sql);

                                // Count Rows To Check Whether We have Category or Not
                                $count =  mysqli_num_rows($res);

                                if($count>0)
                                {
                                    // WE Have Categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // Get the Details of the Category
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    // WE Do Not Have Category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }

                                // Display on Dropdown
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            // Check Whether the button is clcked or not
            if(isset($_POST['submit']))
            {
                // Add the Food in Database
                // echo "Clicked";

                // 1. Get the Data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Check Wether the Radio Button for Featured and Active are Checked or Not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";   // Setting the default value
                }
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";   // Setting the default value
                }

                // 2. Upload the Image if Selected

                // Check Wether the Select Image is Clicked or Not and Upload the Image if Image is Selected
                if(isset($_FILES['image']['name']))
                {
                    // Get the Details of the Selected image    
                    $image_name = $_FILES['image']['name'];

                    // Check Wether the Image is Selected or Not
                    if($image_name!= "")
                    {
                        // Image is Selectd 

                        // A. Rename the Image 
                        // Get the Extantion of Selected Image 
                        $ext = end(explode('.',$image_name));
                        // Create New Name For Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; // New Image Name 

                        // B. Upload the Image 
                        // Get the src Path And Destination Path

                        // Source path is Current Location of The Image
                        $src = $_FILES['image']['tmp_name'];

                        // Destination path for the Image to be Uploaded
                        $dst = "../images/food/".$image_name; 

                        // Finnaly Upload the Food Image
                        $upload = move_uploaded_file($src,$dst);

                        // Check Wether the Image is Uploaded or Not
                        if($upload == false)
                        {
                            // Failed to Upload the Image
                            // Redirect to Add Food Page With Error Message 
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload the Image</div>";
                            header("location:".SITEURL."admin/add-food.php");
                            // Stop the Process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name="";    // Setting Default Value as Blank
                }

                // 3. Insert into Database

                // Create a SQL Query to Save or Add Food
                $sql2 = "INSERT INTO tbl_food sET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check Whether the Data Inserted or Not
                if($res == true)
                {
                    // Data Inserted
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }
                else
                {
                    // Failed to Insert
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                }

                // 4. Redirect with Message to Manage Food Page
            }
        
        ?>

    </div>
</div>

<?php include("partials/footer.php")?>