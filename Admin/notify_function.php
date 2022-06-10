<?php
session_start();
include('../config/db_connection.php');

if (isset($_POST['btn_update'])) {
    if (!empty($_POST['new_id'])) {
        $new_id = $_POST['new_id'];
    }
    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
    }
    if (!empty($_POST['active'])) {
        $active = $_POST['active'];
    }

    $sql = "UPDATE tbl_paging SET status = '$status', active = '$active' WHERE id = '$new_id'";
    $res = mysqli_query($conn, $sql);

    if ($res === TRUE) {
        header('location:' . SITEURL . 'Admin/notify.php?success=Successfully Update');
    } else {
        header('location:' . SITEURL . 'Admin/notify.php?error=Not Added');
    }
}
