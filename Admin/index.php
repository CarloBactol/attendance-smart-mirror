<?php
// include('./partials/menu.php');

// if (!isset($_SESSION['user'])) {
//     header('location:' . SITEURL . 'Admin/login.php');
// }
?>

<!-- Alert -->
<!-- <section class="alert_frontend" id="alert" style="margin-top: 100px; position: absolute; top: -20px; left: 20px; display: block; width: 100%; z-index: 2;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
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
</section> -->

<!-- <section style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-header text-center text-white my-4">Dashboard</h4>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card border-success" style="border-left: 10px solid green;">
                    <div class="card-header text-center bg-secondary">
                        Total Annnouncements
                    </div>
                    <div class="card-body text-center">
                        <h2 class="text-center">
                            <?php
                            $sql = "SELECT * FROM tbl_announcement";
                            $res = mysqli_query($conn, $sql);
                            $get = mysqli_fetch_array($res);

                            $count = mysqli_num_rows($res);
                            echo $count;
                            ?>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-3">
                <div class="card border-success" style="border-left: 10px solid green;">
                    <div class="card-header text-center bg-secondary">
                        Total Staffs
                    </div>
                    <div class="card-body text-center">
                        <h2 class="text-center">
                            <?php
                            $sql = "SELECT * FROM tbl_staff";
                            $res = mysqli_query($conn, $sql);
                            $get = mysqli_fetch_array($res);

                            $count = mysqli_num_rows($res);
                            echo $count;
                            ?>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-3">
                <div class="card border-success" style="border-left: 10px solid green;">
                    <div class="card-header text-center bg-secondary">
                        Total Pagings
                    </div>
                    <div class="card-body text-center">
                        <h2 class="text-center">
                            <?php
                            $sql = "SELECT * FROM tbl_paging";
                            $res = mysqli_query($conn, $sql);
                            $get = mysqli_fetch_array($res);

                            $count = mysqli_num_rows($res);
                            echo $count;
                            ?>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-3">
                <div class="card border-success" style="border-left: 10px solid green;">
                    <div class="card-header text-center bg-secondary">
                        Total Admin
                    </div>
                    <div class="card-body text-center">
                        <h2 class="text-center">
                            <?php
                            $sql = "SELECT * FROM tbl_admin";
                            $res = mysqli_query($conn, $sql);
                            $get = mysqli_fetch_array($res);

                            $count = mysqli_num_rows($res);
                            echo $count;
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('./partials/footer.php'); ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    hello
</body>

</html>