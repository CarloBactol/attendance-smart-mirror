<?php
include('../config/db_connection.php');


if (isset($_POST['btn_login'])) {

    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    }

    $sql = "SELECT * FROM tbl_admin";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $db_username = $row['username'];
            $db_password = $row['password'];

            if ($username == $db_username && $password == $db_password) {
                $_SESSION['user'] = $username;
                header('location:' . SITEURL . 'Admin/?success=Successfully Login');

                exit();
            } else {
                header('location:' . SITEURL . 'Admin/login.php?error=Login Failed');
            }
        }
    }
}
