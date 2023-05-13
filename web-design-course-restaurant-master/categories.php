<?php require_once('partials-front/menu.php') ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
        $sql = "SELECT * FROM `tbl_catagory` WHERE `active`='yes'";
        $res = $conn->query($sql);
        $count = mysqli_num_rows($res);
        if ($count >= 1) {

            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>

                <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                        if($image_name!=""){
                        ?>
                        <img src="images/category/<?=$image_name?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }else{
                            echo "<div class='error-text'>Image is not added.</div>";
                        }
                        ?>

                        <h3 class="float-text text-white"><?= $title ?></h3>
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



    <?php require_once('partials-front/footer.php'); ?>