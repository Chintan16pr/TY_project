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
                                    <td>1.</td>
                                    <td></td>
                                    <td>₹20</td>
                                    <td>Image</td>
                                    <td>Yes</td>
                                    <td>No</td>
                                    <td>
                                        <a href="#" class="btn-secondary">Update Admin</a>
                                        <a href="#" class="btn-danger">Delete Admin</a>
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