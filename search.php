<?php include("./partials/menu.php"); ?>
<?php

//initilize variables
$card = "";

//check if isset btn_search
if (isset($_POST['btn_search'])) {
    if (!empty($_POST['search'])) {
        $search = $_POST['search'];
    }

    // query select data from database
    $sql2 = "SELECT * FROM tbl_staff WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
    //run query
    $result = mysqli_query($conn, $sql2);
    //check if there number of results
    $count = mysqli_num_rows($result);
    //check if there a count of results
    if ($count > 0) {
        //loop the data 
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $image = $row['image'];
            $description = $row['description'];

            if ($row == TRUE) {
                $card .= '<div class="card mb-3" style="margin: 0 auto;">
                <img class="" src="./images/staff/' . $image . '" alt="Card image" height="300px" width="100%">
                <div class="card-body">
                    <h4 class="card-title">' . $name . '</h4>
                    <p>' . $description . '</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertModal' . $id . '">
                        Page Now
                    </button>
                </div>
                </div>';
?>
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
            } else {
                header('location:' . SITEURL . '?error=Not data found!');
            }
        }
    } else {
        header('location:' . SITEURL . '?error=No data found!');
    }
}

?>

<section class="paging" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center text-light my-3">
                <h3>Search Result</h3>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <?php echo $card; ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>

<?php include('./partials/footer.php'); ?>