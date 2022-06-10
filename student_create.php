<?php
session_start();
include("./config/db_connection.php");

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

                <?php if (isset($_SESSION['name'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo SITEURL . 'profile.php?profile'  ?>">Profile</a>
                            <a class="dropdown-item" href="<?php echo SITEURL . 'notification.php?notify'  ?>">Notification</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class='nav-item'>
                        <a <?php if (isset($_GET['student_login']) == 'student_login') {
                            ?> class="nav-link active" <?php } else {
                                                        ?> class="nav-link" <?php
                                                                        } ?> href="<?php echo SITEURL ?>student_login.php?student_login">Login</a>
                    </li>
                <?php } ?>
            </ul>

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

    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-12">
                <form action="student_function.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-light">
                                    <label for="student_id">Student ID</label>
                                    <?php
                                    $code = rand(100, 9999);
                                    //  date("Y-m-d") Year/Month/Date
                                    $unq_user_id = "STUDENT_" . $code . "_" .  date("Y-m-d");
                                    ?>
                                    <input type="text" name="student_id" class="form-control use-keyboard-input" value="<?php echo $unq_user_id; ?>" placeholder="Enter Student ID" required>
                                </div>
                                <div class="form-group text-light">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control use-keyboard-input" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group text-light">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control use-keyboard-input" value="<?php echo $unq_user_id; ?>" placeholder="*******" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroup">Section</label>
                                    </div>
                                    <select class="custom-select" name="section" id="inputGroup" required>
                                        <option selected>Choose Section</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroup">Grade Level</label>
                                    </div>
                                    <select class="custom-select" name="grade" id="inputGroup" required>
                                        <option selected>Choose Grade</option>
                                        <option value="7">Grade 7</option>
                                        <option value="8">Grade 8</option>
                                        <option value="9">Grade 9</option>
                                        <option value="10">Grade 10</option>
                                        <option value="11">Grade 11</option>
                                        <option value="12">Grade 12</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btn_insert_student" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Footer -->
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