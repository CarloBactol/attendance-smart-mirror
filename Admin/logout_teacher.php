<?php
//incluge constan php for urlsite
include('../config/db_connection.php');
session_start();
$id_session = $_SESSION['id'];
$sql = "SELECT * FROM tbl_admin WHERE id = '$id_session' ";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) === 1) {
    $row = mysqli_fetch_assoc($res);

    $unset_id = $row['id'] == $id_session;

    unset($unset_id);
    // session_unset();
    // session_destroy();
    header('Location:' . SITEURL . 'Admin/login.php');
}
