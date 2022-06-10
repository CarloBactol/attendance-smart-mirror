<?php
session_start();
include('./config/db_connection.php');

$id_session = $_SESSION['studentID'];
$sql = "SELECT * FROM tbl_student WHERE studentID = '$id_session' ";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) === 1) {
    $row = mysqli_fetch_assoc($res);

    $unset_id = $row['id'] == $id_session;

    unset($unset_id);
    // session_unset();
    session_destroy();
    header('Location:' . SITEURL . 'index.php?success=You are sign out!');
} else {
    header('Location:' . SITEURL . 'student_login.php');
}
