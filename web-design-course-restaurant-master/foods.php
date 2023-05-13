<?php require_once('partials-front/menu.php');
require_once('partials-front/search.php');
?>




    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql="SELECT * FROM `tbl_food` WHERE `active`='yes'";
            $res=$conn->query($sql);
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
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

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php require_once('partials-front/footer.php'); ?>