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
                        <!-- <li class="nav-item">
                            <a <?php if (isset($_GET['staff']) == 'staff') {
                                ?> class="nav-link active" <?php } else {
                                                            ?> class="nav-link" <?php
                                                                            } ?> href="<?php echo SITEURL ?>Admin/staff.php?staff">Staff</a>
                        </li> -->
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

        <!-- admin -->
        <section class="admin_section" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-header text-center text-white">Administration </h4>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Add Administration
                        </button>
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

                        <!-- Modal Insert-->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Administration</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="admin_function.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <input type="text" name="description" class="form-control" placeholder="Enter Description" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php
                                                        $code = rand(1, 9999);
                                                        //  date("Y-m-d") Year/Month/Date
                                                        $unq_user = "TEACHER_" . $code . "_" .  date("Y-m-d");
                                                        ?>
                                                        <label for="username">Username</label>
                                                        <input type="text" name="username" class="form-control" value="<?php echo $unq_user; ?>" placeholder="Enter Username" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" class="form-control" value="<?php echo $unq_user; ?>" placeholder="********" required>
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
                                                            <label class="input-group-text" for="input_select">Role</label>
                                                        </div>
                                                        <select class="custom-select" name="role" id="input_select" required>
                                                            <option selected>Choose...</option>
                                                            <option value="is_admin">Admin</option>
                                                            <option value="is_teacher">Teacher</option>
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
                        <table class="table mt-5 text-light">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Image</th>
                                    <th>Role</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //initial value set to empty
                                $id = $username = $image = $role = $date = "";

                                // query
                                $sql = "SELECT * FROM tbl_admin WHERE role ='is_teacher'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $username = $row['username'];
                                        $image = $row['image'];
                                        $role = $row['role'];
                                        $date = $row['date']; ?>
                                        <tr>
                                            <td><?php if ($id == True) {
                                                    echo $id;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($name == True) {
                                                    echo $name;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($username == True) {
                                                    echo $username;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($image == True) {
                                                    echo '<img class="rounded-circle border border-success" src="../images/admin/' . $image . '" alt="' . $username . '" width="40px" height="40px">';
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($role == True) {
                                                    echo 'Teacher';
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($date == True) {
                                                    echo $date;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($id == True) { ?>
                                                    <div class="row" style="gap: 10px;">
                                                        <button type="button" class="btn btn-primary px-3" data-toggle="modal" data-target="#edit_admin<?php echo $row['id']; ?>">
                                                            Edit
                                                        </button>
                                                        <form action="admin_function.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                                                            <input type="hidden" name="delete_image" value="<?php echo $row['image'] ?>">
                                                            <button type="submit" id="delete" class="btn btn-danger" name="btn_delete">Delete</button>
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
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Update Profile</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="admin_function.php" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <input type="hidden" class="form-control" name="new_id" value="<?php echo $id; ?>">
                                                                <div class="col-md-12">

                                                                    <div class="form-group">
                                                                        <label for="name">name</label>
                                                                        <?php if ($name == TRUE) { ?>
                                                                            <input type="text" name="name" class="form-control is-valid" value="<?php echo $name; ?>" placeholder="Enter Name" required>
                                                                        <?php } else { ?>
                                                                            <input type="text" name="name" class="form-control is-invalid" placeholder="Enter Name" required>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="username">Username</label>
                                                                        <?php if ($username == TRUE) { ?>
                                                                            <input type="text" name="username" class="form-control is-valid" value="<?php echo $username; ?>" placeholder="Enter Name" required>
                                                                        <?php } else { ?>
                                                                            <input type="text" name="username" class="form-control is-invalid" placeholder="Enter Name" required>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="image">Image</label>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <img src="../images/admin/<?php echo $image; ?>" alt="<?php echo $username; ?>" class="w-100 ">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputFile">File input</label>
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" name="image" class="custom-file-input">
                                                                                <label class="custom-file-label">Choose file</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <label class="input-group-text">Role</label>
                                                                        </div>
                                                                        <select class="custom-select is-valid" name="role" required>
                                                                            <option selected value="<?php echo $role; ?>"><?php echo $role; ?> -(current)</option>
                                                                            <option value="is_admin">Admin</option>
                                                                            <option value="is_admin">Teacher</option>
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


        <script src="../js/jquery-manified.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                bsCustomFileInput.init()
            })
        </script>


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