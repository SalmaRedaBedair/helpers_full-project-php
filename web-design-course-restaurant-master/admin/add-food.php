<?php
include_once("partials/menu.php");
require_once('partials/image.php');
?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br />

        <?php
        session("upload");
        ?>

        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" placeholder="Title of the food" name="title">
                        <?php
                        message("Title");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="40" rows="5"
                            placeholder="Description of the food"></textarea>
                        <?php
                        message("Description");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="0">
                        <?php
                        message("Price");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
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
                            $sql = "SELECT * FROM `tbl_catagory`";
                            $res = $conn->query($sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $active = $row['active'];
                                    $category = $row['title'];
                                    if ($active == 'yes') {
                                        ?>
                                        <option value="<?= $id ?>"><?= $category ?></option>
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
                        <input type="submit" class="btn-secondary" value="Add Food" name="submit">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<!-- manin-content section ends -->

<?php 
include_once("partials/footer.php") ;
ob_start();
?>


<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $title = string_validation($conn, $title, "Title");
    $description = $_POST['description'];
    $description = string_validation($conn, $description, "Description");
    $price = $_POST['price'];
    $price = number_validation($conn, $price, "Price");
    $category_id = $_POST['category'];
    $category_id = number_validation($conn, $category_id, "Category");
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_new_name = image($conn, $image_name, "food");
    } else {
        $image_new_name = "";
    }
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else
        $featured = "";
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else
        $active = "";
    $featured = string_validation($conn, $featured, 'Featured');
    $active = string_validation($conn, $active, 'Active');

    if (isset($_SESSION['Title']) || isset($_SESSION['Description']) || isset($_SESSION['Price']) || isset($_SESSION['Category']) || isset($_SESSION['image']) || isset($_SESSION['Featured']) || isset($_SESSION['Active'])) {
        header('LOCATION:' . SITEURL . 'admin/add-food.php');
        exit();
    }
    $sql2 = "INSERT INTO `tbl_food`(`title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) 
                               VALUES ('$title','$description',$price,'$image_new_name',$category_id,'$featured','$active')";
    $res2 = $conn->query($sql2);
    if ($res2 == 1) {
        $_SESSION['add_food'] = "<div class='success'>Food added successfully</div>";
        header("LOCATION:" . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['add_food'] = "<div class='error'>Food not added!</div>";
        header("LOCATION:" . SITEURL . 'admin/manage-food.php');
    }
}
ob_end_flush();
?>