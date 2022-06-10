<?php
include('./config/db_connection.php');

// Insert Paging
if (isset($_POST['btn_insert'])) {

    if (!empty($_POST['std_id']) && !empty($_POST['name']) && !empty($_POST['purpose'])) {

        $staff_name = $_POST['staff_name'];
        $std_id = $_POST['std_id'];
        $name = $_POST['name'];
        $purpose = $_POST['purpose'];

        $sql = "SELECT * FROM tbl_student WHERE studentID = '$std_id'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                if ($row['studentID'] == $std_id) {
                    $sql2 = "INSERT INTO tbl_paging(staff_name, name, purpose, student_id) VALUES('$staff_name','$name','$purpose','$student_id')";
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2 == TRUE) {
                        header('location:' . SITEURL . 'paging.php?success=true');
                    } else {
                        header('location:' . SITEURL . 'paging.php?error=false');
                    }
                } else {
                    header('location:' . SITEURL . 'paging.php?error=false');
                }
            }
        } else {
            header('location:' . SITEURL . 'paging.php?error=Not data');
        }
    } else {
        header('location:' . SITEURL . 'paging.php?error=Not Autorized');
    }
}
