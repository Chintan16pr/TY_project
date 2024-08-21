<?php
    // Start Session
    session_start();

    // Create Constance to Store Non Repeating Values
    define('SITEURL','http://localhost/TY_project/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food_order');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // DataBase Conection 
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>