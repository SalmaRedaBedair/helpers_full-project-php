<?php 
ob_start();
include_once("partials/menu.php") ?>

        <!-- manin-content section starts -->
        <div class="main-content">
        <div class="wrapper">
        <h1>Change password</h1>
        <?php 
        if(isset($_GET['id']))
        $id=$_GET['id'];
        //echo $id;
        session('change');
        ?>
        

        <br/><br/>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current password: </td>
                    <td>
                        <input type="password" class="current_password" placeholder="current password" name="current_password">
                        <?php 
                        message("Current-password")
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New password: </td>
                    <td>
                        <input type="password" class="new_password" placeholder="New password" name="new_password">
                        <?php 
                        message("New-password")
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Confirm password: </td>
                    <td>
                        <input type="password" class="confirm_password" placeholder="Confirm password" name="confirm_password">
                        <?php 
                        message("Confirm-password")
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="submit" class="btn-secondary" value="chane password" name="change">
                    </td>
                </tr>
            </table>
        </form>

            </div>
        </div>
        <!-- manin-content section ends -->

        <?php include_once("partials/footer.php") ?>


<?php
if(isset($_POST['change']))
{
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];
    $confirm_password=$_POST['confirm_password'];
    $current_password=password_validation($conn,$current_password,"Current-password");
    $new_password=password_validation($conn,$new_password,"New-password");
    $confirm_password=password_validation($conn,$confirm_password,"Confirm-password");

    if(isset($_SESSION['Current-password'])||isset($_SESSION['New-password'])||isset($_SESSION['Confirm-password']))
    {
        header('LOCATION:'.SITEURL.'admin/change-password.php');
        exit();
    }

    $current_password=md5($current_password);
    $new_password=md5($new_password);
    $confirm_password=md5($confirm_password);
    try{
        // get data from database and check wether that user is exist or not
    $sql="SELECT * FROM `tbl_admin` WHERE `id`=$id AND `password`='$current_password'";
    //echo $sql;
    //die();
    $res=$conn->query($sql);
    
    if(mysqli_num_rows($res)==1)
    {
        // $_SESSION['change']="<div class='success'>Admin is found</div>";
        if($new_password==$confirm_password)
        {
            $sql="UPDATE `tbl_admin` SET `password`='$new_password' WHERE `id`=$id";
            $res=$conn->query($sql);
            if($res==true)
            {
                $_SESSION['change']="<div class='success'>password updated successfully.</div>";
                header('LOCATION:'.SITEURL.'admin/manage-admin.php');
            }
        }else{
            $_SESSION['change']="<div class='error'>new password doesn't match confirm password</div>";
            header('LOCATION:'.SITEURL.'admin/change-password.php');
        }
    }else{
        $_SESSION['change']="<div class='error'>Admin is not found</div>";
        header('LOCATION:'.SITEURL.'admin/manage-admin.php');
    }

    }catch(Exception $e)
    {
        echo $e->getMessage();
    }
    
ob_end_flush();
}
?>