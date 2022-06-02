<?php

include('../config/db_connection.php');


// insert new staff
if (isset($_POST['btn_insert'])) {

    if (!empty($_POST['active'])) {
        $active = $_POST['active'];
    }

    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }

    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
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
            $image = "Image_Staff_" . rand(000, 999) . '.' . $ext;  // e.g. Food_Category_834.jpg

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/staff/" . $image;

            //Finally Upload the Image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether image is uploaded or not
            //and if the image is not uploaded then we will stop the process and redirect with error message
            if ($upload == false) {
                //redirect to add category page
                header('location:' . SITEURL . 'Admin/staff.php?error=Not added');
                //stop the process
                die();
            }
        }
    } else {
        //dont upload image and set the image_name as blank
        $image = "";
    }

    //create sql query to insert category into database
    $sql = "INSERT INTO tbl_staff(name, description, image, active) VALUES ('$name', '$description', '$image', '$active')";

    //execute the query and save in database
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not and data added or not
    if ($res == true) {
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/staff.php?success=Successfully added');
    } else {
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/staff.php?success=Not added');
    }
}


//Edit staff
if (isset($_POST['btn_update'])) {

    //new id to update
    $new_id  = $_POST['new_id'];

    if (!empty($_POST['active'])) {
        $active = $_POST['active'];
    }

    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
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
            $image = "Image_Staff_" . rand(000, 999) . '.' . $ext;  // e.g. Food_Category_834.jpg

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/staff/" . $image;

            //Finally Upload the Image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether image is uploaded or not
            //and if the image is not uploaded then we will stop the process and redirect with error message
            if ($upload == false) {
                //redirect to add category page
                header('location:' . SITEURL . 'Admin/staff.php?error=Not Added');
                //stop the process
                die();
            }
        }
    } else {
        //dont upload image and set the image_name as blank
        $image = "";
    }

    //create sql query to insert category into database
    $sql = "UPDATE tbl_staff SET name='$name', description='$description', image='$image', active='$active' WHERE id='$new_id'";

    //execute the query and save in database
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not and data added or not
    if ($res == true) {
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/staff.php?success=Successfully Update');
    } else {
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/staff.php?success=Not Added');
    }
}


//delete staff by id
if (isset($_POST['btn_delete'])) {
    $delete_id = $_POST['delete_id'];
    $delete_image = $_POST['delete_image'];
    //sql to delete announcement
    $sql = "DELETE FROM tbl_staff WHERE id='$delete_id'";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the query executed or not
    if ($res == true) {
        // delete image from the file
        unlink("../images/staff/" . $delete_image);
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/staff.php?success=Successfully Deleted');
    } else {
        //redirect to manage category page
        header('location:' . SITEURL . 'Admin/staff.php?error=Not Deleted some went wrong!');
    }
}
