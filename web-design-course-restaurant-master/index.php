<?php require_once('partials-front/menu.php');
require_once('partials-front/search.php');
?>

<?php
if(isset($_SESSION['category']))
{
    echo $_SESSION['category'];
    unset($_SESSION['category']);
}

if(isset($_SESSION['order']))
{
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php

        $sql = "SELECT * FROM `tbl_catagory` WHERE `featured`='yes' AND `active`='yes' LIMIT 3";
        $res = $conn->query($sql);
        $count = mysqli_num_rows($res);
        if ($count >= 1) {

            while ($row = mysqli_fetch_assoc($res)) {
                $category_id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>

                <a href="<?= SITEURL ?>category-foods.php?category_id=<?= $category_id ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name != "") {
                            ?>
                            <img src="images/category/<?= $image_name ?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                        } else {
                            echo "<div class='error-text'>Image is not added.</div>";
                        }
                        ?>

                        <h3 class="float-text text-white">
                            <?= $title ?>
                        </h3>
                    </div>
                </a>

                <?php
            }

        } else {
            echo "<div class='error-text'>No categories added.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM `tbl_food` WHERE `featured`='yes' AND `active`='yes' LIMIT 6";
        $res2 = $conn->query($sql2);
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">

                        <?php
                        if ($image_name != "") {
                            ?>
                            <img src="<?= SITEURL ?>images/food/<?= $image_name ?>" alt="<?= $title ?>"
                                class="img-responsive img-curve">

                            <?php
                        } else {

                            echo "<div class='error'>Image is not available</div>";
                        }


                        ?>


                    </div>
                    <div class="food-menu-desc">
                        <h4>
                            <?= $title ?>
                        </h4>
                        <p class="food-price">$<?= $price ?>
                        </p>
                        <p class="food-detail">
                            <?= $description ?>
                        </p>
                        <br>

                        <a href="<?= SITEURL ?>order.php?food_id=<?= $id ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "<div class='error'>Food is not available</div>";
        }
        ?>






        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php require_once('partials-front/footer.php'); ?>