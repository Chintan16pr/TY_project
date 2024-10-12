    <?php include("partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD Search Section Ends Here -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // Create Sql Query to Display Category From Database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                // Execute the Query
                $res = mysqli_query($conn ,$sql);
                // Count Rows to Check WEther the CAtegory is Available or Not
                $count = mysqli_num_rows($res);

                if($count > 0 )
                {
                    // Category Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get The Value Like Id,Title,Image Name 
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                // Check Wether Image is Available or Not
                                    if($image_name == "")
                                    {
                                        // Display Message
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    else{
                                        // Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                            </a>
                        <?php

                    }
                }
                else
                {
                    // Category Not Available
                    echo "<div class='error'>Category Not Added.</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                // Getting Food From Database that are active and featured
                $sql2 = "SELECT * from tbl_food WHERE active='Yes' AND featured = 'Yes' LIMIT 6 ";
                // Executing Query
                $res2 = mysqli_query($conn,$sql2);
                // count rows
                $count2 = mysqli_num_rows($res2);
                // Check Wether Food Available or not
                if($count > 0)
                {
                    // Food Available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        // Get all the Values
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                        // Check Wether Image Available or Not
                                        if($image_name=="")
                                        {
                                            // Image not Available
                                            echo "<div class='error'>Image Not Available.</div>";
                                        }
                                        else
                                        {
                                            // Image Available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    // Food Not Available
                    echo "<div class='error'>Food Not Available.</div>";
                }

            ?>



            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include("partials-front/footer.php"); ?>