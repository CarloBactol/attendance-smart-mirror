<?php
//incluge constan php for urlsite
include('../config/db_connection.php');

session_destroy();
header('Location:' . SITEURL . 'Admin/login.php');
exit();
