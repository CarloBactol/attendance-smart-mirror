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

        <section style="margin-top: 100px;">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-header text-center text-light mt-5">Announcements</h4>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Add Announcements
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
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="announce_function.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <input type="text" name="title" class="form-control" placeholder="Enter Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="image">Image</label>
                                                        <input type="file" name="image" class="form-control" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="inputGroupSelect01">Active</label>
                                                        </div>
                                                        <select class="custom-select" name="active" id="inputGroupSelect01" required>
                                                            <option selected>Choose...</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
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
                                    <th>Image</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //initial value set to empty
                                $id = $title = $image = $active = "";

                                // query
                                $sql = "SELECT * FROM tbl_announcement WHERE active='Yes' ";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        $image = $row['image'];
                                        $active = $row['active']; ?>
                                        <tr>
                                            <td><?php if ($id == True) {
                                                    echo $id;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($title == True) {
                                                    echo $title;
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($image == True) {
                                                    echo '<img src="../images/announcement/' . $image . '" alt="' . $title . '" width="60px">';
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($active == True) {
                                                    echo '<span class="text-success">' . $active . '</span>';
                                                } else {
                                                    echo "No data Found";
                                                } ?></td>
                                            <td><?php if ($id == True) { ?>
                                                    <div class="row" style="gap: 10px;">
                                                        <button type="button" class="btn btn-primary px-3" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">
                                                            Edit
                                                        </button>
                                                        <form action="announce_function.php" method="POST" enctype="multipart/form-data">
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
                                        <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="announce_function.php" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <input type="hidden" class="form-control" name="new_id" value="<?php echo $id; ?>">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="title">Title</label>
                                                                        <input type="text" name="title" class="form-control" placeholder="Enter Name" value="<?php echo $title; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="image">Image</label>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <img src="../images/announcement/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="w-100">
                                                                            </div>
                                                                        </div>
                                                                        <input type="file" name="image" class="form-control" required>
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <label class="input-group-text" for="inputGroupSelect01">Active</label>
                                                                        </div>
                                                                        <select class="custom-select" name="active" id="inputGroupSelect01" required>
                                                                            <option selected value="<?php echo $active; ?>"><?php echo $active; ?> -(current)</option>
                                                                            <option value="Yes">Yes</option>
                                                                            <option value="No">No</option>
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