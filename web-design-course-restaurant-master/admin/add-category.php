<?php include_once("partials/menu.php") ;
require_once('partials/image.php');
?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>
        <br />

        <?php
        session("add_category");
        session("upload");
        ?>

        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" placeholder="Enter the title" name="title">
                        <?php
                        message("Title");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                        <?php
                        message("image");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                        <?php
                        message("Featured");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                        <?php
                        message("Active");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn-secondary" value="Add category" name="submit">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<!-- manin-content section ends -->

<?php include_once("partials/footer.php") ?>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $title = string_validation($conn, $title, "Title");
    if (isset($_FILES['image']['name'])) {
        $image_new_name = image($conn,$_FILES['image']['name'],"category");
    } else {
        $image_new_name = "";
    }
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    }
    
    $featured = string_validation($conn, $featured, 'Featured');
    $active = string_validation($conn, $active, 'Active');

    if (isset($_SESSION['title']) || isset($_SESSION['image']) || isset($_SESSION['Featured']) || isset($_SESSION['Active']))
    {
        header('LOCATION:' . SITEURL . 'admin/add-category.php');
        exit();
    }

    $sql = "INSERT INTO `tbl_catagory`(`title`, `image_name`, `featured`, `active`) VALUES ('$title','$image_new_name','$featured','$active')";
    $res = $conn->query($sql);
    if ($res == 1) {
        $_SESSION['add_category'] = "<div class='success'>Category added successfully</div>";
        header("LOCATION:" . SITEURL . 'admin/manage-category.php');

    } else {
        $_SESSION['add_category'] = "<div class='error'>Category not added!</div>";
        header("LOCATION:" . SITEURL . 'admin/add-category.php');
    }


}
?>