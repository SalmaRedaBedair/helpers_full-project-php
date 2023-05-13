<?php
// die();
require_once('../config/constants.php');
foreach (glob("../validation/*.php") as $filename) {
    require_once $filename;
}
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    $id=$_GET['id'];
    $id = number_validation($conn, $id, "Id");
    if (isset($_SESSION['Id'])) {
        unset($_SESSION['Id']);
        header("LOCATION:" . SITEURL . "admin/manage-admin.php");
        exit();
    }
    $image_name=$_GET['image_name'];
    $image_name = image_validation($conn, $image_name);
    if (isset($_SESSION['image'])) {
        unset($_SESSION['image']);
        header("LOCATION:" . SITEURL . "admin/manage-admin.php");
        exit();
    }
    // echo $id.' '.$image_name;
    //die();
    if($image_name!="")
    {
        $path='../images/category/'.$image_name;
        // echo $path;
        // die();
        $remove=unlink($path);
        // echo $remove;
        // die();
        if($remove==false)
        {
            $_SESSION['remove']="<div class='error'>Failed to remove category image.</div>";
            header('LOCATION:'.SITEURL.'admin/manage-category.php');
            die();
        }
    }
    $sql="DELETE FROM `tbl_catagory` WHERE `id`=$id";
    $res=$conn->query($sql);
    if($res==true)
    {
        $_SESSION['delete']="<div class='success'>Category is deleted successfully.</div>";
        header('LOCATION:'.SITEURL.'admin/manage-category.php');
    }else{
        $_SESSION['delete']="<div class='error'>Failed to delete category.</div>";
        header('LOCATION:'.SITEURL.'admin/manage-category.php');
    }
}else{
    header('LOCATION:'.SITEURL.'admin/manage-category.php');
}
?>