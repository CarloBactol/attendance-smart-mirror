<?php include("./partials/menu.php"); ?>


<!-- Alert -->
<section class="alert_frontend" id="alert" style="margin-top: 100px; position: absolute; top: -20px; left: 20px; display: block; width: 100%; z-index: 2;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
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
            </div>
        </div>
    </div>
</section>

<!-- Paging -->
<section class="paging" style="margin-top: 100px;">
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12 text-center text-light my-5">
                <h3>Paging</h3>
            </div>
            <?php
            // query select staff data
            $sql = "SELECT * FROM tbl_staff WHERE active = 'Yes' ";
            //run query
            $res = mysqli_query($conn, $sql);
            //check if have a number of row data
            $count = mysqli_num_rows($res);
            //check if there are count more than one
            if ($count > 0) {
                // loop the results
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $image = $row['image'];
            ?>

                    <div class="col-md-4">
                        <div class="card mb-3" style="margin: 0 auto;">
                            <img class="" src="./images/staff/<?php echo $image; ?>" alt="Card image" height="200px; border-radius-top: 4px">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $name; ?></h4>
                                <p class="card-text"><?php echo $description; ?></p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertModal<?php echo $id; ?>">
                                    Page Now
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Insert-->
                    <div class="modal fade" id="insertModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Paging</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-8 d-flex" style="margin: 0 auto; justify-content: center; align-items: center; gap: 10px; padding-top: 10px;">
                                            <img src="./images/staff/<?php echo $image; ?>" class="rounded-circle border border-secondary" alt="" width="100" height="100">
                                            <span><?php echo $name; ?></span>

                                        </div>
                                    </div>
                                </div>
                                <form action="paging_function.php" method="POST" enctype="multipart/form-data">
                                    <!-- staff name -->
                                    <input type="hidden" name="staff_name" value="<?php echo $name; ?>">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact">Contact</label>
                                                    <input type="text" name="contact" class="form-control" placeholder="e.g: +6309083950222" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="purpose">Purpose</label>
                                                    <textarea name="purpose" class="form-control" rows="5" placeholder="Enter Your Purpose" required></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="btn_insert_paging" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
            <?php
                }
            } else {
                echo "no data available";
            }
            ?>
        </div>
    </div>

</section>

<?php include('./partials/footer.php'); ?>