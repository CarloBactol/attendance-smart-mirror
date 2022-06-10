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
    <!-- navbar -->
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
            </ul>
            <form method="post" action="<?php echo SITEURL ?>search.php" enctype="multipart/form-data" action="" class="form-inline my-2 my-lg-0">
                <input class="form-control use-keyboard-input" class="form-control mr-sm-2 use-keyboard-input" type="search" name="search" placeholder="Search Paging" aria-label="Search" required>
                <button type="submit" name="btn_search" class="btn btn-primary">Search</button>
            </form>

        </div>
    </nav>

    <!-- Alert -->
    <section class="alert_frontend" id="alert" style="margin-top: 100px; position: absolute; top: -20px; left: 20px; display: block; width: 100%; z-index: 2;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <!-- Alert Message Error -->
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="container mt-3 mx-auto" id="alert">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="alert alert-danger" role="alert"><?php echo $_GET['error']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Alert Message Success -->
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="container mt-3 mx-auto" id="alert">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="alert alert-success" role="alert"><?php echo $_GET['success']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Alert -->
                </div>
            </div>
        </div>
    </section>


    <!-- Paging -->
    <section class="announecement" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center text-light my-3">
                    <h3>Paging</h3>
                </div>

                <?php
                // query select staff data
                $sql = "SELECT * FROM tbl_admin WHERE  role = 'is_teacher' ORDER BY id DESC";
                //run query
                $res = mysqli_query($conn, $sql);
                //check if have a number of row data
                $count = mysqli_num_rows($res);
                //check if there are count more than one
                if ($count > 0) {
                    // loop the results
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $role = $row['role'];
                        $image = $row['image'];

                ?>
                        <!-- card -->
                        <div class="col-md-4">
                            <div class="card mb-3" style="margin: 0 auto;">
                                <img class="" src="./images/admin/<?php echo $image; ?>" alt="Card image" height="200px">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $name; ?></h4>
                                    <p><?php if ($role == 'is_teacher') {
                                            echo 'Teacher';
                                        } ?></p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view_announce<?php echo $row['id']; ?>">
                                        View
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Insert-->
                        <div class="modal fade" id="view_announce<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Paging</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="container-fluid">
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="paging_function.php" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input type="hidden" name="staff_name" value="<?php echo $name; ?>">
                                                        <h4 class="text-center italic"><?php echo $name; ?></h4>
                                                        <img src="./images/admin/<?php echo $image; ?>" class="img-thumbnail" height="100px" alt="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="stdId">Student ID</label>
                                                        <input class="form-control use-keyboard-input" type="text" name="std_id" placeholder="Enter your ID">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Student Name</label>
                                                        <input class="form-control use-keyboard-input" type="text" name="name" placeholder=" Enter your name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Purpose</label>
                                                        <textarea class="form-control use-keyboard-input" name="purpose" placeholder="Message" rows="3"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="btn_insert" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
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


</body>

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

</html>