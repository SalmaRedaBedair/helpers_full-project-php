<?php include_once("partials/menu.php") ?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br />
        <?php
        session("add_category");
        session("remove");
        session("delete");
        session("upload");
        session("category-not-found");
        session("update_category");
        ?>

        <!-- button to add admin-->

        <br /><br />
        <a href="add-category.php" class="btn-primary link">Add Category</a>
        <br /><br /><br />

        <table class="full-table">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php

            $sql = "SELECT * FROM `tbl_catagory`";
            $res = $conn->query($sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>
                    <tr>
                        <td>
                            <?= $sn++ ?>
                        </td>
                        <td>
                            <?= $title ?>
                        </td>
                        <td>
                            <?php
                            if($image_name!="")
                            {
                                ?>
                                <img src="<?=SITEURL?>images/category/<?=$image_name?>" width="100px">
                                <?php
                            }else 
                            echo "<div class='error_text'>Image is not added</div>";
                            ?>
                        </td>
                        <td>
                            <?= $featured ?>
                        </td>
                        <td>
                            <?= $active ?>
                        </td>
                        <td>
                            <a href="<?= SITEURL ?>admin/update-category.php?id=<?=$id?>" class="btn-secondary link">Update Category</a>
                            <a href="<?= SITEURL ?>admin/delete-category.php?id=<?=$id?>&image_name=<?=$image_name?>" class="btn-danger link">Delete Category</a>
                        </td>

                    </tr>
                    <?php
                }



            } else {

                ?>
                <tr>
                    <td colspan="6" class="text-center"> No category added. </td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>
<!-- manin-content section ends -->

<?php include_once("partials/footer.php") ?>