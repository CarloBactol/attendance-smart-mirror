<?php
include('./partials/menu.php');
?>


<section class="admin_section" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-header text-center text-white">Admin List</h4>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Add Admin
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
                                <h5 class="modal-title" id="exampleModalLongTitle">Add Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="admin_function.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="********" required>
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
                                                    <label class="input-group-text" for="input_select">Active</label>
                                                </div>
                                                <select class="custom-select" name="active" id="input_select" required>
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
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //initial value set to empty
                        $id = $username = $image = $active = $date = "";

                        // query
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            while ($row = mysqli_fetch_array($res)) {
                                $id = $row['id'];
                                $username = $row['username'];
                                $image = $row['image'];
                                $active = $row['active'];
                                $date = $row['date']; ?>
                                <tr>
                                    <td><?php if ($id == True) {
                                            echo $id;
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
                                    <td><?php if ($active == True) {
                                            if ($active === 'No') {
                                                echo '<span class="text-danger">' . $active . '</span>';
                                            } else {
                                                echo '<span class="text-success">' . $active . '</span>';
                                            }
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
                                                <h5 class="modal-title" id="exampleModalLongTitle">Update Admin Profile</h5>
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
                                                                    <label class="input-group-text">Active</label>
                                                                </div>
                                                                <select class="custom-select is-valid" name="active" required>
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
<script src="../js/jquery-manified.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init()
    })
</script>

<?php include('./partials/footer.php'); ?>