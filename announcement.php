<?php
session_start();
include('./config/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <?php
    if (isset($_SESSION['new_paging'])) { ?>
        <!-- <meta http-equiv="refresh" content="3"> -->
    <?php } else { ?>
        <meta charset="UTF-8">
    <?php }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 css-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <!-- Bootstrap 4 js -->
    <script src="./js/jquery.slim.min.js" defer></script>
    <script src="./js/bootstrap.bundle.min.js" defer></script>

    <link rel="stylesheet" href="./css/keyboard.css">

    <title>Smart Mirror</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body style="overflow-x: hidden; background-color: #000;">


    <!-- navabar -->
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

        </div>
    </nav>


    <!-- Announcement -->
    <section class="announecement" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center text-light my-3">
                    <h3>Announcements</h3>
                </div>

                <?php
                // query select staff data
                $sql = "SELECT * FROM tbl_announcement WHERE active = 'Yes' ";
                //run query
                $res = mysqli_query($conn, $sql);
                //check if have a number of row data
                $count = mysqli_num_rows($res);
                //check if there are count more than one
                if ($count > 0) {
                    // loop the results
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image = $row['image'];
                ?>
                        <!-- card -->
                        <div class="col-md-4">
                            <div class="card mb-3" style="margin: 0 auto;">
                                <img class="" src="./images/announcement/<?php echo $image; ?>" alt="Card image" height="200px">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $title; ?></h4>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view_announce<?php echo $row['id']; ?>">
                                        View Announcement
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Insert-->
                        <div class="modal fade" id="view_announce<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Announcement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="container-fluid">

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>
                                                    <span class="badge badge-success "><?php echo $title; ?></span>
                                                </h4>
                                                <img src="./images/announcement/<?php echo $image; ?>" alt="" width="100%" height="200px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->

                <?php }
                } ?>

            </div>
        </div>
    </section>


    <div class="container text-center text-light my-5">
        <div class="h4">Footer</div>
    </div>

    <script>
        // set Timeout alert
        const timeOut = setTimeout(Alert, 3000);

        function Alert() {
            document.getElementById("alert").remove();
        }

        // set Timeout alert
        const timeOutTemp = setTimeout(AlertTemp, 3000);

        function AlertTemp() {
            document.getElementById("alertTemp").remove();
        }
    </script>
    <script src="./js/keyboard.js"></script>
</body>

</html>