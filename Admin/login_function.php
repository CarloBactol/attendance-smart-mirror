<?php
session_start();
include('../config/db_connection.php');


if (isset($_POST['btn_login'])) {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];


        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' AND role = '$role'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) === 1) {
            $row = mysqli_fetch_assoc($res);
            if ($row['username'] === $username && $row['password'] === $password) {
                if ($row['role'] == 'is_admin') {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['role_admin'] = 'is_admin';
                    header('location:' . SITEURL . 'Admin/index.php?success=Welcomeback ');
                } else {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['role_teacher'] = 'is_teacher';
                    header('location:' . SITEURL . 'Admin/teacher.php?success=Welcomeback ');
                }
            } else {
                header('location:' . SITEURL . 'Admin/login.php?error=Invalid Creadentials');
                exit();
            }
        } else {
            header('location:' . SITEURL . 'Admin/login.php?error=Invalid Creadentials');
        }
    }
}
