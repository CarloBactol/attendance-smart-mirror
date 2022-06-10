<?php
include('../config/db_connection.php');
session_start();
$session_id = $_SESSION['id'];
$sql = "SELECT * FROM tbl_admin WHERE id = '$session_id'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) === 1) {
    $row = mysqli_fetch_assoc($res); ?>

    <?php if (isset($_SESSION['id'])) {
        if ($_SESSION['id'] == $row['id']) {

            $name = $tr = "";
            $session_user = $_SESSION['name'];
            $sql = "SELECT * FROM tbl_paging WHERE staff_name = '$session_user' AND active = 'processing'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {

                    $student_id = $row['student_id'];
                    $active = $row['active'];
                    $name = $row['name'];
                    $purpose = $row['purpose'];
                    $date = $row['date'];

                    $tr .= '<tr>
                    <td>
                    ' . '<span class="text-warning">' . $active . '</span>' . '
                    </td>
                    <td>' . $student_id . '</td>
                    <td>' . $name . '</td>
                    <td>' . $purpose . '</td>
                    <td>' .  date('Y-m-d H:i:sa', strtotime($date)) . '</td>
                    <td>
                    <button type="button" class="btn btn-primary px-3" data-toggle="modal" data-target="#editModal' . $row['id'] . '">
                     Status
                   </button>
                    </td>
                <tr>';

    ?>
                    <!-- Modal Edit-->
                    <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="notify_function.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row">
                                            <input type="hidden" class="form-control" name="new_id" value="<?php echo  $row['id']; ?>">
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="inputGroupSelect01">Notify</label>
                                                    </div>
                                                    <select class="custom-select" name="status" id="inputGroupSelect01" required>
                                                        <option selected value="<?php echo $active; ?>">Status</option>
                                                        <option value="available">Im Available</option>
                                                        <option value="not_available">Not Available</option>
                                                    </select>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="inputGroupSelect01">Actuve</label>
                                                    </div>
                                                    <select class="custom-select" name="active" id="inputGroupSelect01" required>
                                                        <option selected value="<?php echo $row['active']; ?>">Active</option>
                                                        <option value="processing">Processing</option>
                                                        <option value="complete">Complete</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="btn_update" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
            <?php
                }
            }
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
                        if ($_SESSION['role_teacher'] == 'is_teacher') { ?>
                            <ul class="navbar-nav mr-auto">
                                <li class='nav-item'>
                                    <a <?php if (isset($_GET['teacher']) == 'teacher') {
                                        ?> class="nav-link active" <?php } else {
                                                                    ?> class="nav-link" <?php
                                                                                    } ?> href="<?php echo SITEURL ?>Admin/teacher.php?teacher">Dashboard</a>
                                <li class="nav-item">
                                    <a <?php if (isset($_GET['messsage']) == 'messsage') {
                                        ?> class="nav-link active" <?php } else {
                                                                    ?> class="nav-link" <?php
                                                                                    } ?> href="<?php echo SITEURL ?>Admin/notify.php?messsage">Message</a>
                                </li>
                                <?php if ($_SESSION['username']) { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php echo $_SESSION['username']; ?>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="<?php echo SITEURL . 'Admin/profile.php?profile'  ?>">Profile</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="logout_teacher.php">Logout</a>
                                        </div>
                                    </li>
                                <?php  } ?>
                            </ul>
                        <?php }  ?>
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

                <!-- table-message -->
                <section style="margin-top: 100px">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-hover text-light">
                                    <thead>
                                        <tr>
                                            <th>Active</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Purpose</th>
                                            <th>Date & Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($tr == TRUE) {
                                            echo $tr;
                                        } else {
                                            echo '<tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>No Paging Available</td>
                                        </tr>';
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end-table -->

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