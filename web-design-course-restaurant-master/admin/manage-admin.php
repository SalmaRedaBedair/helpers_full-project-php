<?php include_once("partials/menu.php") ?>

        <!-- manin-content section starts -->
        <div class="main-content">
        <div class="wrapper">
        <h1>Manage Admin</h1>

        <?php
        session("add");
        session("delete");
        session("update");
        session("change");
        ?>

        <!-- button to add admin-->

        <br/><br/>
        <a href="add-admin.php" class="btn-primary link" >Add Admin</a>
        <br/><br/><br/>

        <table class="full-table">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
            <?php 
            $sn=1;
            $sql="SELECT * FROM `tbl_admin`";
            $res=$conn->query($sql);
            //print_r($res);
            if(($res->num_rows)>0){
                while($rows=mysqli_fetch_assoc($res))
                {
                    $id=$rows['id'];
                    $full_name=$rows['full_name'];
                    $user_name=$rows['user_name'];
                

            ?>
            <tr>
                <td><?= $sn++ ?></td>
                <td><?= $full_name ?></td>
                <td><?= $user_name ?></td>
                <td>
                <a href="<?= SITEURL ?>admin/change-password.php?id=<?=$id?>" class="btn-primary link" >Change Password</a>    
                <a href="<?= SITEURL ?>admin/update-admin.php?id=<?=$id?>" class="btn-secondary link" >Update Admin</a>
                <a href="<?= SITEURL ?>admin/delete-admin.php?id=<?=$id?>" class="btn-danger link" >Delete Admin</a>
                </td>
            </tr>
            <?php }
            } 
            ?>
        </table>
            </div>
        </div>
        <!-- manin-content section ends -->

<?php include_once("partials/footer.php") ?>