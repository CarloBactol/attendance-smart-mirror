<?php
session_start();
include('../config/db_connection.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dashboard</title>

    <!-- Bootstrap 4 css-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Bootstrap 4 js -->
    <script src="../js/jquery.slim.min.js" defer></script>
    <script src="../js/bootstrap.bundle.min.js" defer></script>
</head>
<style>
    body {
        background-color: #000;
    }

    .login_section .form_wrapper {
        width: 100% !important;
        height: 100vh !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }

    .form {
        padding: 40px !important;

    }
</style>

<body style="overflow-x: hidden">

    <!-- Alert -->
    <section class="alert_frontend" id="alert" style="margin-top: 100px; position: absolute; top: -20px; left: 20px; display: block; width: 100%; z-index: 2;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <!-- Alert Message Error -->
                    <?php if (isset($_GET['error'])) { ?>
                        <script>
                            swal({
                                title: "<?php echo $_GET['error']; ?>",
                                text: "You have an error. Please try again!",
                                icon: "error",
                                button: "Ohh no!",
                            });
                        </script>
                    <?php } ?>
                    <!-- Alert Message Success -->
                    <?php if (isset($_GET['success'])) {

                    ?>
                        <script>
                            swal({
                                title: "<?php echo $_GET['success']; ?>",
                                text: "Welcome back <?php echo $_GET['success'] . " " . date('F j, Y g:i:a'); ?>",
                                icon: "success",
                                button: "Aww yiss!",
                            });
                        </script>
                    <?php } ?>
                    <!-- End Alert -->
                </div>
            </div>
        </div>
    </section>

    <section class="login_section">
        <div class="form_wrapper">
            <form action="login_function.php" method="POST" enctype="multipart/form-data" class="form border text-light">
                <h4 class="text-center">Admin Login</h4>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroup">Select Login Confirmation</label>
                    </div>
                    <select class="custom-select" name="role" id="inputGroup" required>
                        <option selected>Choose Login Status</option>
                        <option value="is_admin">Admin</option>
                        <option value="is_teacher">Teacher</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="btn_login" class="btn btn-primary form-control">Login</button>
                </div>
            </form>
        </div>
    </section>

</body>
<script>
    // set Timeout alert
    const timeOut = setTimeout(Alert, 4000);

    function Alert() {
        document.getElementById("alert").remove();
    }
</script>

</html>