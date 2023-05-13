<?php require_once('partials-front/menu.php') ;

if(isset($_GET['category_id']))
{
    $category_id=$_GET['category_id'];
    $sql="SELECT `title` FROM `tbl_catagory` WHERE `id`=$category_id";
    $res=$conn->query($sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
    }else{
        $_SESSION['category']='<div class="error">There is an error!!<br>We can not find that category.</div>';
        header('location:'.SITEURL); 
    }
}else{
    header('location:'.SITEURL);
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?= $title ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>



             <?php
            $sql2="SELECT * FROM `tbl_food` WHERE `category_id`=$category_id";
            $res2=$conn->query($sql2);
            $count2=mysqli_num_rows($res2);
            if($count2>0)
            {
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];
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