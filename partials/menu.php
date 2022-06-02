<?php
include('./config/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 css-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <!-- Bootstrap 4 js -->
    <script src="./js/jquery.slim.min.js" defer></script>
    <script src="./js/bootstrap.bundle.min.js" defer></script>


    <title>Smart Mirror</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body style="overflow-x: hidden; background-color: #000;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="./images/logo.png" width="100" height="60" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class='nav-item'>
                    <a <?php if (isset($_GET['home']) == 'home') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>?home">Home</a>
                </li>
                <li class='nav-item'>
                    <a <?php if (isset($_GET['announcement']) == 'announcement') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>announcement.php?announcement">Announcement</a>
                </li>
                <li class='nav-item'>
                    <a <?php if (isset($_GET['paging']) == 'paging') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>paging.php?paging">Paging</a>
                </li>
                <li class='nav-item'>
                    <a <?php if (isset($_GET['contact']) == 'contact') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>contact.php?contact">Contact</a>
                </li>

            </ul>
            <form method="post" action="<?php echo SITEURL ?>search.php" enctype="multipart/form-data" action="" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search Paging" aria-label="Search" required>
                <button type="submit" name="btn_search" class="btn btn-primary">Search</button>
            </form>
        </div>
    </nav>