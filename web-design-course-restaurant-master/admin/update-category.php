<?php include_once("partials/menu.php");
include_once("partials/image.php");
 ?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>update category</h1>
        <br />

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $id = number_validation($conn, $id, "number");
            if (isset($_SESSION['number'])) {
                $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
                unset($_SESSION['number']);
                header("LOCATION:" . SITEURL . "admin/manage-category.php");
                exit();
            }
            $sql = "SELECT * FROM `tbl_catagory` WHERE `id`=$id";
            $res = $conn->query($sql);
            if (mysqli_num_rows($res) >= 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['category-not-found'] = "<div class='error'>Cateory not found</div>";
                header('LOCATION:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
            header('LOCATION:' . SITEURL . 'admin/manage-category.php');
            exit();
        }
        ?>

        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" placeholder="Enter the title" name="title" value="<?= $title ?>">
                        <?php
                        message('Title');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == '')
                            echo "<div class='error_text'>The image is not found</div>";
                        else {
                            ?>
                            <img src="<?= SITEURL ?>images/category/<?= $current_image ?>" alt="Here is an image"
                                width="100">
                        <?php }
                        ?>
                        <?php
                        message('Current-image');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                        <?php
                        message('image');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes" <?php if ($featured == 'yes')
                            echo 'checked'; ?>>Yes
                        <input type="radio" name="featured" value="no" <?php if ($featured == 'no')
                            echo 'checked'; ?>>No
                        <?php
                        message('Featured');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes" <?php if ($active == 'yes')
                            echo 'checked'; ?>>Yes
                        <input type="radio" name="active" value="no" <?php if ($active == 'no')
                            echo 'checked'; ?>>No
                        <?php
                        message('Active');
                        ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value='<?= $current_image ?>'>
                        <input type="hidden" name="id" value='<?= $id ?>'>
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
    $id = $_POST['id'];
    $current_image = $_POST['current_image'];

    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "";
    }

    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "";
    }
    $title = string_validation($conn, $title, "Title");
    $id = number_validation($conn, $id, "Id");
    $current_image = image_validation($conn, $current_image, "Current-image");
    $featured = string_validation($conn, $featured, "Featured");
    $active = string_validation($conn, $active, "Active");

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_name = image($conn, $image_name, "category","not-required");
        // remove current image
        if (!isset($_SESSION['image'])&&$current_image != "") {
            $remove_path = "../images/category/" . $current_image;
            // echo $remove_path;
            // die();
            $remove = unlink($remove_path);
            if ($remove == 0) {
                $_SESSION['upload'] = "<div class='error'>Failed to delete current image!</div>";
                header('LOCATION:' . SITEURL . 'admin/manage-category.php');
                die();
            }
        }

    } else if ($current_image != ""&&isset($current_image)) {
        $image_name = $current_image;
    } else {
        $image_name = "";
    }
    if($image_name==""||!isset($image_name))
    {
        $image_name=$current_image;
    }
    if (isset($_SESSION['Title']) || $_SESSION['Id'] || isset($_SESSION['Current-image']) || $_SESSION['image'] || isset($_SESSION['Featured']) || $_SESSION['Active']) {
        header('LOCATION:' . SITEURL . "admin/update-category.php?id=$id");
        exit();
    }


    $sql2 = "UPDATE `tbl_catagory` SET `title`='$title',`image_name`='$image_name',`featured`='$featured',`active`='$active' WHERE `id`=$id";
    $res2 = $conn->query($sql2);

    if ($res2 == true) {
        $_SESSION['update_category'] = "<div class='success'>Category updated successfully.</div>";
        header('LOCATION:' . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['update_category'] = "<div class='error'>Failed to updated category!</div>";
        header('LOCATION:' . SITEURL . 'admin/manage-category.php');
    }


}
?>