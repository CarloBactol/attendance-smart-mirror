<?php include("./partials/menu.php"); ?>


<section class="announecement" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center text-light my-3">
                <h3>Announcements</h3>
            </div>

            <?php
            // query select staff data
            $sql = "SELECT * FROM tbl_announcement WHERE active = 'Yes' ";
            //run query
            $res = mysqli_query($conn, $sql);
            //check if have a number of row data
            $count = mysqli_num_rows($res);
            //check if there are count more than one
            if ($count > 0) {
                // loop the results
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image = $row['image'];
            ?>
                    <!-- card -->
                    <div class="col-md-4">
                        <div class="card mb-3" style="margin: 0 auto;">
                            <img class="" src="./images/announcement/<?php echo $image; ?>" alt="Card image" height="200px">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $title; ?></h4>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view_announce<?php echo $row['id']; ?>">
                                    View Announcement
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Insert-->
                    <div class="modal fade" id="view_announce<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Announcement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container-fluid">

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>
                                                <span class="badge badge-success "><?php echo $title; ?></span>
                                            </h4>
                                            <img src="./images/announcement/<?php echo $image; ?>" alt="" width="100%" height="200px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->

            <?php }
            } ?>

        </div>
    </div>
</section>



<?php include('./partials/footer.php'); ?>