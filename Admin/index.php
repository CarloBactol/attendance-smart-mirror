<?php
include('../config/db_connection.php');
session_start();

?>

<?php if (isset($_SESSION['role_admin'])) {

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
    </head>

    <body style="overflow-x: hidden; background-color: #000;">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">
                <img src="../images/logo.png" width="100" height="60" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                if ($_SESSION['role_admin'] == 'is_admin') { ?>
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
                            <a <?php if (isset($_GET['admin']) == 'admin') {
                                ?> class="nav-link active" <?php } else {
                                                            ?> class="nav-link" <?php
                                                                            } ?> href="<?php echo SITEURL ?>Admin/admin.php?admin">Administration</a>
                        </li>
                        <li class="nav-item">
                            <a <?php if (isset($_GET['temperature']) == 'temperature') {
                                ?> class="nav-link active" <?php } else {
                                                            ?> class="nav-link" <?php
                                                                            } ?> href="<?php echo SITEURL ?>Admin/temperature.php?temperature">Temperature</a>
                        </li>
                        <li class="nav-item">
                            <a <?php if (isset($_GET['student']) == 'student') {
                                ?> class="nav-link active" <?php } else {
                                                            ?> class="nav-link" <?php
                                                                            } ?> href="<?php echo SITEURL ?>Admin/student.php?student">Student</a>
                        </li>

                        <li class="nav-item">
                            <a <?php if (isset($_GET['logout']) == 'logout') {
                                ?> class="nav-link active" <?php } else {
                                                            ?> class="nav-link" <?php
                                                                            } ?> href="<?php echo SITEURL ?>Admin/logout_admin.php">Logout</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </nav>
        <!-- end-navbar -->

        <!-- Alert -->
        <section class="alert_frontend" id="alert" style="margin-top: 100px; position: absolute; top: -20px; left: 20px; display: block; width: 100%; z-index: 2;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <!-- <div class="container mt-3 mx-auto" id="alert">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="alert alert-success" role="alert"><?php echo $new_added; ?></div>
                        </div>
                    </div>
                </div> -->
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="container mt-3 mx-auto" id="alert">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="alert alert-danger" role="alert"><?php echo $_GET['error']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <div class="container mt-3 mx-auto" id="alert">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="alert alert-success" role="alert"><?php echo $_GET['success']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>


        <!-- end Alert -->
        <section style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-header text-center text-white my-4">Dashboard</h4>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="card border-success" style="border-left: 10px solid green;">
                            <div class="card-header text-center bg-secondary">
                                Total Announcements
                            </div>
                            <div class="card-body text-center">
                                <h2 class="text-center">
                                    <?php
                                    $sql = "SELECT * FROM tbl_announcement";
                                    $res = mysqli_query($conn, $sql);
                                    $get = mysqli_fetch_array($res);

                                    $count = mysqli_num_rows($res);
                                    echo $count;
                                    ?>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                        <div class="card border-success" style="border-left: 10px solid green;">
                            <div class="card-header text-center bg-secondary">
                                Total Student Register
                            </div>
                            <div class="card-body text-center">
                                <h2 class="text-center">
                                    <?php
                                    $sql = "SELECT * FROM tbl_student";
                                    $res = mysqli_query($conn, $sql);
                                    $get = mysqli_fetch_array($res);

                                    $count = mysqli_num_rows($res);
                                    echo $count;
                                    ?>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                        <div class="card border-success" style="border-left: 10px solid green;">
                            <div class="card-header text-center bg-secondary">
                                Total Teacher Register
                            </div>
                            <div class="card-body text-center">
                                <h2 class="text-center">
                                    <?php
                                    $sql = "SELECT * FROM tbl_admin WHERE role = 'is_teacher'";
                                    $res = mysqli_query($conn, $sql);
                                    $get = mysqli_fetch_array($res);

                                    $count = mysqli_num_rows($res);
                                    echo $count;
                                    ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <div class="container mt-5">
            footer
        </div>
        <script>
            // set Timeout alert
            const timeOut = setTimeout(Alert, 3000);

            function Alert() {
                document.getElementById("alert").remove();
            }
        </script>
        <!-- Bootstrap 4 js -->
        <script src="../js/jquery.slim.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/bs-custom-file-input.js"></script>
    </body>

    </html>
<?php } else {
    header('location:' . SITEURL . 'Admin/login.php?error=Invalid Creadentials');
} ?>