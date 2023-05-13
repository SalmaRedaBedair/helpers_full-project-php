<?php
include_once('../config/constants.php');
foreach (glob("../validation/*.php") as $filename) {
    require_once $filename;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = number_validation($conn, $id, "Id");
    if (isset($_SESSION['Id'])) {
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin, try again later!</div>";
        unset($_SESSION['Id']);
        header("LOCATION:" . SITEURL . "admin/manage-admin.php");
        // echo $_SESSION['Id'];
        exit();
    }
    $sql = "DELETE FROM `tbl_admin` WHERE `id`=$id";
    $res = $conn->query($sql);
    if ($res >= 1) {
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
        header("LOCATION:" . SITEURL . "admin/manage-admin.php");
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin, try again later!</div>";
        header("LOCATION:" . SITEURL . "admin/manage-admin.php");
    }
} else {
    header("LOCATION:" . SITEURL . "admin/manage-admin.php");
    exit();
}
?>