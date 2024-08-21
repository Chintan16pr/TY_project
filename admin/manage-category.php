<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE CATEGORY</h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset( $_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset( $_SESSION['upload']);
            }
        ?>
        <br/><br/>


                <!-- Button to Add Admin -->
                 <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                 
                 <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // Query to Get all Data From Database
                        $sql = "SELECT * FROM tbl_category";

                        // Execute the Query
                        $res = mysqli_query($conn,$sql);

                        // Count Rows
                        $count = mysqli_num_rows($res);

                        // Check Wether WE Have Data in Database or Not 
                        if($count > 0)
                        {
                            // We have Data in Database
                            // Get Data and Display
                        }
                        else
                        {
                            // We do not have Data
                            // WE Will Display the Message inside table
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No Category Added</div></td>
                            </tr>

                            <?php
                        }

                    ?>

                    <tr>
                        <td>1.</td>
                        <td>chintan prajapati</td>
                        <td>ChintanPrajapati2005</td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#" class="btn-secondary">Update Category</a>
                            <a href="#" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                </table>
    </div>
</div>

<?php include('partials/footer.php') ?>