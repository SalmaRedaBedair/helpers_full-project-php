<?php
ob_start();

include_once("partials/menu.php");
include_once("partials/image.php");
?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>

        <?php
        if (isset($_GET['id'])) {
            $id_food = $_GET['id'];
            $id_food = number_validation($conn, $id_food, "number");
            if (isset($_SESSION['number'])) {
                $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
                header("LOCATION:" . SITEURL . "admin/manage-food.php");
                unset($_SESSION['number']);
                exit();
            }
            $sql = "SELECT * FROM `tbl_food` WHERE `id`=$id_food";
            $res = $conn->query($sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $category_id = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
        } else {
            $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
            header("LOCATION:" . SITEURL . "admin/manage-food.php");
            exit();
        }

        ?>

        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" placeholder="Title of the food" name="title" value="<?= $title ?>">
                        <?php
                        message("Title");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="40" rows="5"
                            placeholder="Description of the food"><?= $description ?></textarea>
                        <?php
                        message("Description");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="0" value="<?= $price ?>">
                        <?php
                        message("Price");
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
                            <img src="<?= SITEURL ?>images/food/<?= $current_image ?>" alt="Here is an image" width="100">
                        <?php }
                        ?>
                        <?php
                        message("Current-image");
                        ?>
                    </td>
                </tr>


                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image">
                        <?php
                        message("image");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>category: </td>
                    <td>
                        <select name="category">

                            <?php
                            $sql3 = "SELECT * FROM `tbl_catagory`";
                            $res3 = $conn->query($sql3);
                            $count3 = mysqli_num_rows($res3);
                            if ($count3 > 0) {
                                while ($row = mysqli_fetch_assoc($res3)) {
                                    $id = $row['id'];
                                    $active = $row['active'];
                                    $category = $row['title'];
                                    if ($active == 'yes') {
                                        ?>
                                        <option value="<?= $id ?>" <?php
                                          if ($id == $category_id)
                                              echo 'selected';
                                          ?>
                                              ><?= $category ?></option>
                                        <?php
                                    }
                                }
                            } else {
                                ?>

                                <option value="0">no category food</option>

                            <?php } ?>
                            <?php
                            message("Category");
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes" checked="<?php if ($featured == 'yes')
                            echo 'checked'; ?>">Yes
                        <input type="radio" name="featured" value="no" checked="<?php if ($featured == 'no')
                            echo 'checked'; ?>">No
                        <?php
                        message("Featured");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes" checked="<?php if ($active == 'yes')
                            echo 'checked'; ?>">Yes
                        <input type="radio" name="active" value="no" checked="<?php if ($active == 'no')
                            echo 'checked'; ?>">No
                        <?php
                        message("Active");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?= $current_image ?>">
                        <input type="hidden" name="id" value="<?= $id_food ?>">
                        <input type="submit" class="btn-secondary" value="Update Food" name="submit">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<!-- manin-content section ends -->


<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    if (isset($_POST['price']))
        $price = $_POST['price'];
    else
        $price = 0;
    $category_id = $_POST['category'];
    $food_id = $_POST['id'];
    if (isset($_POST['current_image']))
        $current_image = $_POST['current_image'];
    else
        $current_image = "";

    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "no";
    }

    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "no";
    }

    $title = string_validation($conn, $title, "Title");
    $description = string_validation($conn, $title, "Description");
    $price = number_validation($conn, $price, "Price");
    $category_id = number_validation($conn, $category_id, "Category");
    $food_id = number_validation($conn, $food_id, "Food");
    if (isset($current_image)&&$current_image!="")
        $current_image = image_validation($conn, $current_image, "Current-image");
    else {
        $current_image = "";
    }
    $featured = string_validation($conn, $featured, "Featured");
    $active = string_validation($conn, $active, "Active");

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_name = image($conn, $image_name, "food", "not-required");

        if (isset($image_name) && $image_name != "" && $current_image != "") {
            $remove_path = '../images/food/' . $current_image;
            $remove = unlink($remove_path);
            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to delete current image!</div>";
                header('LOCATION:' . SITEURL . 'admin/manage-food.php');
                die();
            }
        }
    } else {
        if (isset($current_image)&&$current_image!="")
            $image_name = $current_image;
        else
            $image_name = "";
    }
    if($image_name==""||!isset($image_name))
    {
        $image_name=$current_image;
    }

    if (isset($_SESSION['id'])) {
        $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
        unset($_SESSION['id']);
        header("LOCATION:" . SITEURL . "admin/manage-food.php");
        exit();
    }
    if (isset($_SESSION['Title']) || $_SESSION['Description'] || $_SESSION['Price'] || $_SESSION['Category'] || $_SESSION['Food'] || isset($_SESSION['Current-image']) || $_SESSION['image'] || isset($_SESSION['Featured']) || $_SESSION['Active']) {
        header('LOCATION:' . SITEURL . "admin/update-food.php?id=$food_id");
        exit();
    }


    $sql2 = "UPDATE `tbl_food` SET `title`='$title',`description`='$description',`price`=$price,`image_name`='$image_name',`category_id`='$category_id',`featured`='$featured',`active`='$active' WHERE `id`=$food_id";
    $res2 = $conn->query($sql2);
    if ($res2 == true) {
        $_SESSION['update_food'] = "<div class='success'>Food updated successfully</div>";
        header("LOCATION:" . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['update_food'] = "<div class='error'>Food not updated!</div>";
        header("LOCATION:" . SITEURL . 'admin/manage-food.php');
        // die();
    }
}
?>



<?php include_once("partials/footer.php");
ob_end_flush();
// i add buffer to ensure that no output is sent to the browser until it is ready to be sent.
?>