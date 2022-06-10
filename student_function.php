<?php
session_start();
include('./config/db_connection.php');

$name = $student_id = $password = "";

//check if click the save button
if (isset($_POST['btn_insert_student'])) {

    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (!empty($_POST['student_id'])) {
        $student_id = $_POST['student_id'];
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        // hash password
        $hash_password = md5($password);
    }
    if (!empty($_POST['section'])) {
        $section = $_POST['section'];
    }
    if (!empty($_POST['grade'])) {
        $grade = $_POST['grade'];
    }

    // Insert to the database table tbl_paging
    $sql = "INSERT INTO tbl_student(name, studentID, section, grade, password) VALUES ('$name', '$student_id ', '$section', '$grade', '$hash_password')";
    //run query
    $res = mysqli_query($conn, $sql);

    //check if inserted or not
    if ($res === TRUE) {
        $_SESSION['name'] = $name;
        $_SESSION['studentID'] = $student_id;
        header('location:' . SITEURL . 'paging.php?success=Successfully Login');
        exit();
    } else {
        header('location:' . SITEURL . 'student_login.php?error=Something went wrong!');
        exit();
    }
}
