<?php
include('../config/db_connection.php');
session_start();
date_default_timezone_set('Asia/Manila');

?>
<?php

echo "<span style='color:red;font-weight:bold;'>Date: </span>" . date('F j, Y g:i:a  ');
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
        <!-- datatbable -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>

    <body style=" background-color: #f1f1f1;">

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
                            <a <?php if (isset($_GET['student']) == 'student') {
                                ?> class="nav-link active" <?php } else {
                                                            ?> class="nav-link" <?php
                                                                            } ?> href="<?php echo SITEURL ?>Admin/student.php?student">Student</a>
                        </li>
                        <li class="nav-item">
                            <a <?php if (isset($_GET['temperature']) == 'temperature') {
                                ?> class="nav-link active" <?php } else {
                                                            ?> class="nav-link" <?php
                                                                            } ?> href="<?php echo SITEURL ?>Admin/temperature.php?temperature">Temperature</a>
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

        <!-- student -->
        <section class="admin_section text-dark" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-header text-center text-dark">Student List </h4>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#exampleModalCenter">
                            Add Student
                        </button>
                        <!-- Alert Message Error -->
                        <?php if (isset($_GET['error'])) { ?>
                            <script>
                                swal({
                                    title: "<?php echo $_GET['error']; ?>",
                                    text: "You have an error. Please try again!",
                                    icon: "error",
                                    button: "Aww yiss!",
                                });
                            </script>
                        <?php } ?>
                        <!-- Alert Message Success -->
                        <?php if (isset($_GET['success'])) {

                        ?>
                            <script>
                                swal({
                                    title: "<?php echo $_GET['success']; ?>",
                                    text: "Congrats <?php echo $_GET['success'] . " " . date('F j, Y g:i:a'); ?>",
                                    icon: "success",
                                    button: "Aww yiss!",
                                });
                            </script>
                        <?php } ?>
                        <!-- End Alert -->
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <!-- Modal Insert-->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Student</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="student_function.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="std_id">Student ID</label>
                                                        <?php
                                                        $code = rand(100, 9999);
                                                        $unique_id = "STUDENT_" . $code . "_" . date("Y-m-d");
                                                        ?>
                                                        <input type="text" name="std_id" class="form-control is-valid" value="<?php echo $unique_id; ?>" placeholder="Enter Student ID" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <input type="text" name="description" class="form-control" placeholder="Enter Description" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="image" class="custom-file-input" required>
                                                                <label class="custom-file-label" for="file_edit">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="input_select">Section</label>
                                                        </div>
                                                        <select class="custom-select" name="section" id="input_select" required>
                                                            <option selected>Choose...</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                            <option value="E">E</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="input_select">Grade Level</label>
                                                        </div>
                                                        <select class="custom-select" name="grade" id="input_select" required>
                                                            <option selected>Choose...</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="btn_insert" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->

                        <!-- table -->
                        <table class="table table-striped text-dark  table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //initial value set to empty
                                $id = $studentID = $image = $description = $date = $name = "";

                                // query
                                $sql = "SELECT * FROM tbl_student ORDER BY id DESC";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $grade = $row['grade'];
                                        $section = $row['section'];
                                        $studentID = $row['studentID'];
                                        $image = $row['image'];
                                        $description = $row['description'];
                                        $date = $row['date']; ?>
                                        <tr>
                                            <td><?php if ($studentID == True) {
                                                    echo $studentID;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($name == True) {
                                                    echo $name;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($grade == True) {
                                                    echo $grade;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($section == True) {
                                                    echo $section;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($description == True) {
                                                    echo $description;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($image == True) {
                                                    echo '<img class="rounded-circle border border-success" src="../images/student/' . $image . '" alt="' . $name . '" width="40px" height="40px">';
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($date == True) {
                                                    echo date("F j, Y g:i:a", strtotime($date));
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($id == True) { ?>
                                                    <div class="row d-flex">
                                                        <button type="button" class="btn btn-sm btn-primary px-3 mb-2" data-toggle="modal" data-target="#edit_admin<?php echo $row['id']; ?>">
                                                            Edit
                                                        </button>
                                                        <form class="form" action="student_function.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                                                            <input type="hidden" name="delete_image" value="<?php echo $row['image'] ?>">
                                                            <button type="submit" id="delete" class="btn btn-sm btn-danger" name="btn_delete">Delete</button>
                                                        </form>
                                                    </div>
                                                <?php  } else {
                                                    echo "";
                                                } ?>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit-->
                                        <div class="modal fade" id="edit_admin<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Update Student</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="student_function.php" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <input type="hidden" class="form-control" name="new_id" value="<?php echo $id; ?>">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="std_id">Student ID</label>
                                                                        <?php if ($studentID == TRUE) : ?>
                                                                            <input type="text" name="studentID" class="form-control is-valid" value="<?php echo $studentID; ?>" placeholder="Enter Student ID" required>
                                                                        <?php else : ?>
                                                                            <input type="text" name="studentID" class="form-control is-invalid" value="<?php echo $studentID; ?>" placeholder="Enter Student ID" required>
                                                                        <?php endif ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" name="name" class="form-control is-valid" value="<?php echo $name; ?>" placeholder="Enter Name" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="description">Description</label>
                                                                        <input type="text" name="description" class="form-control is-valid" value="<?php echo $description; ?>" placeholder="Enter Description" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="image">Image</label>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <img src="../images/student/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-thumbnail">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputFile">File input</label>
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" name="image" class="custom-file-input" required>
                                                                                <label class="custom-file-label" for="file_edit">Choose file</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <label class="input-group-text" for="input_select">Section</label>
                                                                        </div>
                                                                        <select class="custom-select is-valid" name="section" id="input_select" required>
                                                                            <option selected value="<?php echo $section ?>"><?php echo $section; ?></option>
                                                                            <option value="A">A</option>
                                                                            <option value="C">C</option>
                                                                            <option value="D">D</option>
                                                                            <option value="E">E</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <label class="input-group-text" for="input_select">Grade Level</label>
                                                                        </div>
                                                                        <select class="custom-select is-valid" name="grade" id="input_select" required>
                                                                            <option selected value="<?php echo $grade ?>"><?php echo $grade; ?></option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="btn_update" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </section>


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

        <!-- datatable -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
                bsCustomFileInput.init();
            });
        </script>

        <!-- Bootstrap 4 js -->
        <!-- <script src="../js/jquery.slim.min.js"></script> -->
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/bs-custom-file-input.js"></script>
    </body>

    </html>
<?php } else {
    header('location:' . SITEURL . 'Admin/login.php?error=Invalid Creadentials');
} ?>