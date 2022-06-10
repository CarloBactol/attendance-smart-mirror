<?php
//incluge constan php for urlsite
include('../config/db_connection.php');

session_start();
unset($_SESSION['role_admin']);
// session_unset();
// session_destroy();
header('Location:' . SITEURL . 'Admin/login.php');
