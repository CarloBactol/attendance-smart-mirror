<?php
include('../config/db_connection.php');


// Edit
if (isset($_POST['btn_update'])) {

    //new id to update
    $new_id  = $_POST['new_id'];

    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
    }

    if (isset($_FILES['image']['name'])) {
        //upload the image
        //to upload image we need image name, source path and destination path
        $image = $_FILES['image']['name'];

        //upload the image only if image is available
        if ($image != "") {
            //auto rename our image
            //get the extension of our image (jpg, png, gif, etc)e.g. "food1.jpg"
            $ext = end(explode('.', $image));

            //rename the image
            $image = "Image_Pagingt_" . rand(000, 999) . '.' . $ext;  // e.g. Food_Category_834.jpg

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/paging/" . $image;

            //Finally Upload the Image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether image is uploaded or not
            //and if the image is not uploaded then we will stop the process and redirect with error message
            if ($upload == false) {
                //redirect to add category page
                header('location:' . SITEURL . 'Admin/paging.php?error=Not Added');
                //stop the process
                die();
            }
        }
    } else {
        //dont upload image and set the image_name as blank
        $image = "";
    }

    //create sql query to insert category into database
    $sql = "UPDATE tbl_paging SET  status='$status' WHERE id='$new_id'";

    //execute the query and save in database
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not and data added or not
    if ($res == true) {
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/paging.php?success=Successfully Update');
    } else {
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/paging.php?success=Not Added');
    }
}


//delete announcement by id
if (isset($_POST['btn_delete'])) {
    $delete_id = $_POST['delete_id'];
    //sql to delete announcement
    $sql = "DELETE FROM tbl_paging WHERE id='$delete_id'";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the query executed or not
    if ($res == true) {

        header('location:' . SITEURL . 'Admin/paging.php?success=Successfully Deleted');
    } else {
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/paging.php?error=Not Deleted some went wrong!');
    }
} else {
    echo 'false';
}
