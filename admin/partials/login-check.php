<?php
    // Authorization - Access Control
    // Check Wether the User is Loggedin or Not
    if(!isset($_SESSION['user']))   // If user Session is Not Set
    {
        // User is Not Logged in
        // Redirect to login Page With Message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to Access Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>