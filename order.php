<?php include("partials-front/menu.php"); ?>

    <?php
        // Check wether the food id is set or not
        if(isset($_GET['food_id']))
        {
            // get the food id and details of selected food
            $food_id = $_GET['food_id']; 

            // get the details of the selected food
            $sql = "SELECT * FROM tbl_food WHERE id = '$food_id'";
            // Executing the query
            $res = mysqli_query($conn, $sql);
            // Count the number of rows returned
            $count = mysqli_num_rows($res);

            // Check Wether the data is available or not
            if($count==1)
            {
                // we have data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                // we don't have data
                header('location:'.SITEURL);
            }  
        }
        else
        {
            // redirect to home page
            header ('location:'.SITEURL);

        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            // Check Wether the image is availabale or not
                            if($image_name == "")
                            {
                                // image is not available
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else
                            {
                                // image is available
                                ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }

                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">₹<?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include("partials-front/footer.php"); ?>