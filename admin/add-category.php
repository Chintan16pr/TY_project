<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        
        <br><br><br>
        
        <!--  Add Category Starts -->
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
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
                        <input type="button" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <!--  Add Category Ends -->
        <?php 
            // Check Wether the Submit is Clicked or Not
            if(isset($_POST['submit']))
            {
                echo "Clicked";
            }
        ?>       
    </div>
</div>

<?php include('partials/footer.php'); ?>