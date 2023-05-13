<?php
function image($conn, $image_name, $image_folder, $required = "required")
{
    if((!isset($image_name)||$image_name=="")&&$required != "required"){
        return "";
    }
    $image_name = image_validation($conn, $image_name);
    if ($image_name != '') {
        $sep = ".";
        $parts = explode($sep, $image_name);
        if (count($parts) > 1)
            $ext = end($parts);
        $image_new_name = $image_folder . time() . '.' . $ext;
        $image_source_path = $_FILES['image']['tmp_name'];
        $image_destination_path = "../images/$image_folder/" . $image_new_name;
        $upload = move_uploaded_file($image_source_path, $image_destination_path);
        if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to upload image!</div>";
            header('LOCATION:' . SITEURL . "admin/manage-$image_folder.php");
            exit();
        }

        return $image_new_name;
    }
    if ($required == "required") {
        $_SESSION['image'] = "Image is required.";
    }
    return "";
}
?>