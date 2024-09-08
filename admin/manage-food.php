<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>
        <br/><br/><br/>

                <!-- Button to Add Admin -->
                 <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                 
                <br/><br/><br/>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorized']))
                    {
                        echo $_SESSION['unauthorized'];
                        unset($_SESSION['unauthorized']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>actions</th>
                    </tr>

                    <?php
                        // Create a Sql Query to Get All the Food
                        $sql = "SELECT * FROM tbl_food";

                        // Execute Query
                        $res = mysqli_query($conn, $sql);

                        // Count Rows to Check Whether we have food or Not
                        $count = mysqli_num_rows($res);

                        // Create Serial Number Variable and Set Default Value as 1
                        $sn = 1;

                        if($count > 0)
                        {
                            // WE Have Food in Database
                            // Get the Food From Database And Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // Get the Value From individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $actice = $row['active'];
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $title; ?></td>
                                    <td>₹<?php echo $price; ?></td>
                                    <td>
                                        <?php 
                                            // Check Whether We Have Image or Not
                                            if($image_name == "")
                                            {
                                                // We Do Not Have Image
                                                // Display Error Message
                                                echo "<div class='error'>Image Not Added.</div>";
                                            }
                                            else
                                            {
                                                // We Have Image
                                                // Display Image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>Images/food/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $actice; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            // Food is Not Added
                            echo "<tr><td colspan='7' class='error'> Food Not Added Yet. </td></tr>";
                        }
                    ?>

                </table>
    </div>
</div>

<?php include('partials/footer.php') ?>