<?php
session_start();
include('./config/db_connection.php');
$studentID = "";
if (isset($_SESSION['studentID']) == true) {
    $studentID = $_SESSION['studentID'];
}



// var_dump($studentID);
// die();
//Initialize value
$li = "";
$i = 0;
$div = "";
// query
$sql = "SELECT * FROM tbl_announcement WHERE active='Yes'  ORDER BY id DESC ";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);

while ($row = mysqli_fetch_assoc($res)) {

    if ($i == 0) {
        $li .=  ' <li data-target="#carouselExampleCaptions" data-slide-to="' . $i . '" class="active"></li>';
        $div .= '<div class="carousel-item active">
                            
                            <img src="./images/announcement/' . $row['image'] . '" class="d-block w-100" alt="...">
                            
                            <div class="carousel-caption  d-sm-block d-md-block">
                                <h5>' . $row['title'] . '</h5>
                                <a href="announcement.php?announcement" class="btn btn-success px-3 mb-2">View</a>
                            </div>
                
                        </div>';
    } else {
        $li .=  ' <li data-target="#carouselExampleCaptions" data-slide-to="' . $i . '"></li>';
        $div .= '<div class="carousel-item">
                            <img src="./images/announcement/' . $row['image'] . '" class="d-block w-100">
                            <div class="carousel-caption  d-sm-block  d-md-block">
                                <h5>' . $row['title'] . '</h5>
                                <a href="announcement.php?announcement" class="btn btn-success px-3 mb-2">View</a>
                            </div>
                        </div>';
    }
    $i++;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <?php
    if (isset($_SESSION['new_paging'])) { ?>
        <!-- <meta http-equiv="refresh" content="3"> -->
    <?php } else { ?>
        <meta charset="UTF-8">
    <?php }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 css-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <!-- Bootstrap 4 js -->
    <script src="./js/jquery.slim.min.js" defer></script>
    <script src="./js/bootstrap.bundle.min.js" defer></script>

    <link rel="stylesheet" href="./css/keyboard.css">

    <title>Smart Mirror</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body style="overflow-x: hidden; background-color: #000;">

    <?php
    $sql = "SELECT * FROM tbl_test order by id desc limit 1";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if (mysqli_num_rows($res) === 1) {
        $row = mysqli_fetch_assoc($res);
    }
    ?>

    <!-- temperature -->
    <div class="container" style="position: fixed; top:0; left: 35%; z-index: 9999; width: 300px;">
        <span id="demo"></span>
    </div>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="./images/logo.png" width="100" height="60" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class='nav-item'>
                    <a <?php if (isset($_GET['home']) == 'home') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>?home">Home</a>
                </li>
                <li class='nav-item'>
                    <a <?php if (isset($_GET['announcement']) == 'announcement') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>announcement.php?announcement">Announcement</a>
                </li>
                <li class='nav-item'>
                    <a <?php if (isset($_GET['paging']) == 'paging') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>paging.php?paging">Paging</a>
                </li>

                <!-- <?php if (isset($_SESSION['name'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo SITEURL . 'profile.php?profile'  ?>">Profile</a>
                            <a class="dropdown-item" href="<?php echo SITEURL . 'notification.php?notify'  ?>">Notification</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class='nav-item'>
                        <a <?php if (isset($_GET['student_login']) == 'student_login') {
                            ?> class="nav-link active" <?php } else {
                                                        ?> class="nav-link" <?php
                                                                        } ?> href="<?php echo SITEURL ?>student_login.php?student_login">Login</a>
                    </li>
                <?php } ?> -->
            </ul>

        </div>
    </nav>

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

    <!-- Slider -->
    <section class="announcements text-center" style="margin-top: 100px">
        <div class="container-fluid  my-5">
            <div class="row">
                <div class="col-md-12 text-center text-light mt-4 mb-3">
                    <h3>Announcements</h3>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php echo $li; ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php echo $div; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>


    <!-- Paging -->


    <!-- Footer -->
    <div class="container text-center text-light my-5">
        <div class="h4">Footer</div>
    </div>

    <script>
        // set Timeout alert

        function Alert() {
            document.getElementById("alert").remove();
        }
    </script>

    <script>
        function loadDoc() {
            var interval = setInterval(function() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("demo").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "temp.php", true);
                xhttp.send();
            }, 1000);
        }
        loadDoc();
        clearInterval(interval);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./js/keyboard.js"></script>
</body>

</html>