<?php include_once("partials/menu.php") ?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br />
        <?php
        session("upload");
        session("delete_food");
        session("update_category");
        session("update_food");
        session("remove");
        session("delete");
        ?>

        <!-- button to add admin-->

        <br /><br />
        <a href="add-food.php" class="btn-primary link">Add Food</a>
        <br /><br /><br />

        <table class="full-table">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php

            $sql = "SELECT * FROM `tbl_food`";
            $res = $conn->query($sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name = $row['image_name'];
                    $category_id=$row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    $sql2="SELECT * FROM `tbl_catagory` WHERE `id`=$category_id";
                    $res2=$conn->query($sql2);
                    $row2=mysqli_fetch_assoc($res2);
                    $category=$row2['title'];

                    ?>
                    <tr>
                        <td>
                            <?= $sn++ ?>
                        </td>
                        <td>
                            <?= $title ?>
                        </td>
                        <td>
                            <?= $description ?>
                        </td>
                        <td>
                            <?= $price ?>
                        </td>
                        <td>
                            <?php
                            if($image_name!="")
                            {
                                ?>
                                <img src="<?=SITEURL?>images/food/<?=$image_name?>" width="100px">
                                <?php
                            }else 
                            echo "<div class='error_text'>Image is not added</div>";
                            ?>
                        </td>
                        <td>
                            <?= $category ?>
                        </td>
                        <td>
                            <?= $featured ?>
                        </td>
                        <td>
                            <?= $active ?>
                        </td>
                        <td>
                            <a href="<?= SITEURL ?>admin/update-food.php?id=<?=$id?>" class="btn-secondary link">Update food</a>
                            <a href="<?= SITEURL ?>admin/delete-food.php?id=<?=$id?>&image_name=<?=$image_name?>" class="btn-danger link">Delete food</a>
                        </td>

                    </tr>
                    <?php
                }



            } else {

                ?>
                <tr>
                    <td colspan="6" class="text-center"> No Food added. </td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>
<!-- manin-content section ends -->

<?php include_once("partials/footer.php") ?>