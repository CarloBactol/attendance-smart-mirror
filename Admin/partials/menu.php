<?php
include('../config/db_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 css-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">




    <title>Smart Mirror</title>

    <!-- Link our CSS file -->
</head>

<body style="overflow-x: hidden; background-color: #000;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="../images/logo.png" width="100" height="60" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class='nav-item'>
                    <a <?php if (isset($_GET['query']) == 'query') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin?query">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a <?php if (isset($_GET['announcement']) == 'announcement') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin/announcement.php?announcement">Announcement</a>
                </li>
                <li class="nav-item">
                    <a <?php if (isset($_GET['paging']) == 'paging') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin/paging.php?paging">Paging</a>
                </li>
                <li class="nav-item">
                    <a <?php if (isset($_GET['admin']) == 'admin') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin/admin.php?admin">Admin</a>
                </li>
                <li class="nav-item">
                    <a <?php if (isset($_GET['staff']) == 'staff') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin/staff.php?staff">Staff</a>
                </li>

                <li class="nav-item">
                    <a <?php if (isset($_GET['logout']) == 'logout') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin/logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a <?php if (isset($_GET['temperature']) == 'temperature') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin/temperature.php?temperature">Temperature</a>
                </li>
            </ul>

        </div>
    </nav>