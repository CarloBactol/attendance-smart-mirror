<?php
//Start Session
session_start();


//create constants to store non repeating values
define('SITEURL', 'http://localhost/Attendance-smart-mirror/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'Attendance');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn)); //database connection
