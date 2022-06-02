<?php

include('./partials/menu.php');

?>


<section style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-header text-center text-white">Paging List</h4>
                <!-- Button trigger modal -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Add Paging
                </button> -->

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
                            <th>Staff Name</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Purpose</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //initial value set to empty
                        $id = $staff_id = $name = $contact = $purpose = "";

                        // query
                        $sql = "SELECT * FROM tbl_paging";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            while ($row = mysqli_fetch_array($res)) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $staff_name = $row['staff_name'];
                                $contact = $row['contact'];
                                $purpose = $row['purpose'];
                                $date = $row['date']; ?>
                                <tr>
                                    <td><?php if ($id == True) {
                                            echo $id;
                                        } else {
                                            echo "No data Found";
                                        } ?></td>
                                    <td><?php if ($staff_name == True) {
                                            echo $staff_name;
                                        } else {
                                            echo "No data Found";
                                        } ?></td>
                                    <td><?php if ($name == True) {
                                            echo $name;
                                        } else {
                                            echo "No data Found";
                                        } ?></td>
                                    <td><?php if ($contact == True) {
                                            echo $contact;
                                        } else {
                                            echo "No data Found";
                                        } ?></td>
                                    <td><?php if ($purpose == True) {
                                            echo $purpose;
                                        } else {
                                            echo "No data Found";
                                        } ?></td>
                                    <td><?php if ($date == True) {
                                            echo $date;
                                        } else {
                                            echo "No data Found";
                                        } ?></td>
                                    <!-- <td><?php if ($id == True) { ?>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">
                                                Edit
                                            </button>
                                            <a href="<?php echo SITEURL ?>Admin/announce_function.php?delete=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                                        <?php  } else {
                                                    echo "";
                                                } ?>
                                    </td> -->
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
                                            <form action="paging_function.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <input type="hidden" class="form-control" name="new_id" value="<?php echo $id; ?>">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter Name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="contact">Contact</label>
                                                                <input type="text" name="contact" value="<?php echo $contact; ?>" class="form-control" placeholder="e.g: +6309083950222" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="purpose">Purpose</label>
                                                                <textarea name="purpose" class="form-control" value="<?php echo $purpose; ?>" rows="5" placeholder="Enter Your Purpose" required></textarea>
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
<script>
    // set Timeout alert
    const timeOut = setTimeout(Alert, 3000);

    function Alert() {
        document.getElementById("alert").remove();
    }
</script>
<?php
include('./partials/footer.php');
?>