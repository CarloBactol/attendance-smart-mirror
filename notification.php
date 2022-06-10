<?php
session_start();
include('./config/db_connection.php');

if (isset($_SESSION['studentID'])) { ?>

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

                    <?php if (isset($_SESSION['studentID'])) { ?>
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

        <?php
        $tr = "";
        $studentID = $_SESSION['studentID'];
        $sql = "SELECT * FROM tbl_paging WHERE student_id = '$studentID' AND active = 'complete'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($res)) {
                $name = $row['name'];
                $teacher_name = $row['staff_name'];
                $student_id = $row['student_id'];
                $status = $row['status'];
                $date = $row['date'];
                $tr .= '<tr>
                            <td>' . $teacher_name . '</td>
                            <td>' . $status . '</td>
                            <td>' . $name . '</td>
                            <td>' . $student_id . '</td>
                            <td>' .  date('Y-m-d H:i:sa', strtotime($date)) . '</td>
                        </tr>';
        ?>
        <?php }
        } ?>

        <section class="contact" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover text-light">
                            <thead>
                                <th>Teacher Name</th>
                                <th>Feedback</th>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                <?php echo $tr; ?>
                                <!-- <tr>
                                    <td><?php echo $teacher_name; ?></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>



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
<?php  } else {
    header('location:' . SITEURL . 'student_login.php?error=You must login first');
}
?>