<?php
include('../config/db_connection.php');
session_start();
$session_id = $_SESSION['id'];

$sql = "SELECT * FROM tbl_admin WHERE id = '$session_id'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) === 1) {
    $row = mysqli_fetch_assoc($res); ?>

    <?php if (isset($_SESSION['id'])) {
        if ($_SESSION['id'] == $row['id']) { ?>
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

                <?php include('./partials/navbar.php') ?>

                <!-- Alert -->
                <section class="alert_frontend" id="alert" style="margin-top: 100px; position: absolute; top: -20px; left: 20px; display: block; width: 100%; z-index: 2;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 mt-3">
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

                <?php

                $session_name = $_SESSION['id'];
                $sql = "SELECT * FROM tbl_admin WHERE id = '$session_id' ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_array($res)) {
                        $name = $row['name'];
                        $description = $row['description'];
                        $role = $row['role'];
                ?>

                        <section class="contact" style="margin-top: 100px;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-center text-light my-3">
                                        <h3>Profile</h3>
                                    </div>
                                    <div class="col-md-12 text-light">
                                        <form action="">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" disabled value="<?php echo $name; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" disabled value="<?php echo $description; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Administration Role</label>
                                                <input type="text" class="form-control" disabled value="<?php if ($role == 'is_teacher') {
                                                                                                            echo 'Teacher';
                                                                                                        } ?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>

                <?php }
                } ?>


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
<?php }
    }
} else {
    header('location:' . SITEURL . 'Admin/login.php?error=Invalid Creadentials');
} ?>