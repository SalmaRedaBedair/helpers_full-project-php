<?php include_once("partials/menu.php") ?>

        <!-- manin-content section starts -->
        <div class="main-content">
        <div class="wrapper">
        <h1>Dashboard</h1>
        <br>
            <?php
            session('login');
            ?>
            <br><br>
            <?php
            $sql1="SELECT * FROM `tbl_catagory`";
            $res1=$conn->query($sql1);
            $count1=mysqli_num_rows($res1);

            $sql2="SELECT * FROM `tbl_food`";
            $res2=$conn->query($sql2);
            $count2=mysqli_num_rows($res2);

            $sql3="SELECT * FROM `tbl_order`";
            $res3=$conn->query($sql3);
            $count3=mysqli_num_rows($res3);

            $sql4="SELECT SUM(total) AS total FROM `tbl_order` WHERE `status`='deliveried'";
            $res4=$conn->query($sql4);
            $row4=mysqli_fetch_assoc($res4);
            $count4=$row4['total'];
            if(!isset($count4))$count4=0;
            ?>
        <div class="col-4 text-center">
            <h2><?=$count1?></h2>
            <br/>
            Categories
        </div>
        <div class="col-4 text-center">
        <h2><?=$count2?></h2>
            <br/>
            Foods
        </div>
        <div class="col-4 text-center">
        <h2><?=$count3?></h2>
            <br/>
            Total orders
        </div>
        <div class="col-4 text-center">
        <h2><?=$count4?></h2>
            <br/>
            Revenue generated
        </div>
        <div class="clearfix"></div>
            </div>
        </div>
        <!-- manin-content section ends -->
        
<?php include_once("partials/footer.php") ?>