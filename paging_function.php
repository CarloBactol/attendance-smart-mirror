<?php include('./config/db_connection.php');

//check if click the save button
if (isset($_POST['btn_insert_paging'])) {

    $staff_name = $_POST['staff_name'];
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (!empty($_POST['contact'])) {
        $contact = $_POST['contact'];
    }
    if (!empty($_POST['purpose'])) {
        $purpose = $_POST['purpose'];
    }

    // Insert to the database table tbl_paging
    $sql = "INSERT INTO tbl_paging(name, staff_name, contact, purpose) Values('$name', '$staff_name', '$contact', '$purpose')";
    //run query
    $res = mysqli_query($conn, $sql);
    //check if inserted or not
    if ($res == TRUE) {
        header('location:' . SITEURL . 'paging.php?success=Successfully Added');
        exit();
    } else {
        header('location:' . SITEURL . 'announcement.php?error=Something went wrong!');
        exit();
    }
}
