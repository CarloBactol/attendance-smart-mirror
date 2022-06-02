<?php

include('./partials/menu.php');

?>


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

<?php
include('./partials/footer.php');
?>