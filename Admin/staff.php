<?php

include('./partials/menu.php');

?>

<section style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-header text-center text-white">Staff</h4>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Add Staff
                </button>

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

                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add Staff</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="newform" action="staff_function.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group p-1">
                                                <label for="username">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required />
                                                <div class="invalid-feedback">name cannot be have a special character and 4 min length</div>
                                                <div class="valid-feedback">Looks Good</div>
                                            </div>
                                            <div class="form-group p-1">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" id="description" name="description" required />
                                                <div class="invalid-feedback">description cannot be blank</div>
                                                <div class="valid-feedback">Looks Good</div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="exampleInputFile">File input</label>
                                                <div class="input-group">
                                                    <div class="custom-file mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" id="image" name="image" class="custom-file-input" id="customFileLangHTML">
                                                            <label class="custom-file-label" for="customFileLangHTML" data-browse="Choose file">Choose file</label>
                                                            <div class="invalid-feedback mb-3">Required file extension |jpeg, jpg, png, gift|</div>
                                                            <div class="valid-feedback mb-3">Looks Good</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="active">Active</label>
                                                <select class="custom-select" name="active" id="active" required>
                                                    <option selected disabled>Choose...</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <div class="invalid-feedback">Active option is not selected</div>
                                                <div class="valid-feedback">Looks Good</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="btn_insert" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
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
                            <th>Description</th>
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
                        $sql = "SELECT * FROM tbl_staff WHERE active='Yes' ";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            while ($row = mysqli_fetch_array($res)) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $description = $row['description'];
                                $image = $row['image'];
                                $active = $row['active']; ?>
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
                                    <td><?php if ($description == True) {
                                            echo $description;
                                        } else {
                                            echo "No data Found";
                                        } ?></td>
                                    <td><?php if ($image == True) {
                                            echo '<img src="../images/staff/' . $image . '" alt="' . $name . '" width="60px">';
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
                                                <form action="staff_function.php" method="POST" enctype="multipart/form-data">
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
                                            <form action="staff_function.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <input type="hidden" class="form-control" name="new_id" value="<?php echo $id; ?>">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" class="form-control is-valid" id="user" placeholder="Enter Name" value="<?php echo $name; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <input type="text" name="description" class="form-control is-valid" placeholder="Enter Description" value="<?php echo $name; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for="imageCurrent">Current Image</label>
                                                                        <img src="../images/staff/<?php echo $image; ?>" class="img-thumbnail" id="imageCurrent" alt="" width="100%" height="200px">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="exampleInputFile">New Image</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file mb-3">
                                                                        <div class="custom-file">
                                                                            <input type="file" id="img" name="image" class="custom-file-input" id="customFileLangHTML">
                                                                            <label class="custom-file-label" for="customFileLangHTML" data-browse="Choose file">New Image</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <label class="input-group-text" for="inputGroupSelect01">Active</label>
                                                                </div>
                                                                <select class="custom-select is-valid" name="active" id="inputGroupSelect01" required>
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

                                            <!-- <form action="staff_function.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group p-1">
                                                                <label for="username">Name</label>
                                                                <input type="text" class="form-control" is-valid id="user" value="<?php echo $name; ?>" name="name" required />
                                                                <div class="invalid-feedback">name cannot be have a special character and 4 min length</div>
                                                                <div class="valid-feedback">Looks Good</div>
                                                            </div>
                                                            <div class="form-group p-1">
                                                                <label for="description">Description</label>
                                                                <input type="text" class="form-control" id="desc" value="<?php echo $description; ?>" name="description" required />
                                                                <div class="invalid-feedback">description cannot be blank</div>
                                                                <div class="valid-feedback">Looks Good</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for="imageCurrent">Current Image</label>
                                                                        <img src="../images/staff/<?php echo $image; ?>" class="img-thumbnail" id="imageCurrent" alt="" width="100%" height="200px">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="exampleInputFile">New Image</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file mb-3">
                                                                        <div class="custom-file">
                                                                            <input type="file" id="img" name="image" class="custom-file-input" id="customFileLangHTML">
                                                                            <label class="custom-file-label" for="customFileLangHTML" data-browse="Choose file">New Image</label>
                                                                            <div class="invalid-feedback mb-3">Required file extension |jpeg, jpg, png, gift|</div>
                                                                            <div class="valid-feedback mb-3">Looks Good</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="active">Active</label>
                                                                <select class="custom-select" name="active" id="act" required>
                                                                    <option selected value="<?php echo $active; ?> -(current)"><?php echo $active; ?> -(current)</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                                <div class="invalid-feedback">Active option is not selected</div>
                                                                <div class="valid-feedback">Looks Good</div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="btn_update" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form> -->
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

<?php
// validation Insert Form 
include('./validation/insert_form_staff.php');
// footer
include('./partials/footer.php');
?>