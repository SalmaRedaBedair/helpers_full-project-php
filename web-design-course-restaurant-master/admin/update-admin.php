<?php include_once("partials/menu.php") ?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $id = number_validation($conn, $id, "number");
            if (isset($_SESSION['number'])) {
                $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
                unset($_SESSION['number']);
                header("LOCATION:" . SITEURL . "admin/manage-admin.php");
                exit();
            }
            $sql = "SELECT * FROM `tbl_admin` WHERE `id`=$id";
            $res = $conn->query($sql);
            if ($res) {
                $count = $res->num_rows;
                if ($count == true) {
                    // echo '1';
                    $row = mysqli_fetch_assoc($res);
                    // print_r($res);
                    $full_name = $row['full_name'];
                    $user_name = $row['user_name'];
                    // echo $full_name.$user_name;
                } else {
                    $_SESSION['update'] = "<div class='error'>Admin is not available</div>";
                    header("LOCATION:" . SITEURL . "admin/manage-admin.php");
                }
            } else {
                $_SESSION['delete'] = "<div class='error'>Failed to update admin, try again later!</div>";
                header("LOCATION:" . SITEURL . "admin/manage-admin.php");
            }
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
            header("LOCATION:" . SITEURL . "admin/manage-admin.php");
            exit();
        }

        ?>

        <br /><br />

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" class="full name" placeholder="Enter your name" name="fullname"
                            value='<?= $full_name ?>'>
                            <?php
                            message("Name");
                            ?>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" class="username" placeholder="Your username" name="username"
                            value="<?= $user_name ?>">
                            <?php
                            message("Username");
                            ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input type="submit" class="btn-secondary" value="udate Admin" name="update">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<!-- manin-content section ends -->

<?php include_once("partials/footer.php") ?>

<?php
if (isset($_POST['update'])) {
    $id=$_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];

    $full_name=string_validation($conn,$full_name,"Name");
    $user_name=string_validation($conn,$username,"Username");

    if(isset($_SESSION['Name'])||$_SESSION['Username'])
    {
        header('LOCATION:'.SITEURL."admin/update-admin.php?id=$id");
        exit();
    }

    // echo $full_name.$username.$password;

    $sql = "UPDATE `tbl_admin` SET `full_name`='$fullname',`user_name`='$username' WHERE id=$id";

    if ($conn->query($sql)) {
        $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
        header('LOCATION: ' . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
        header('LOCATION: ' . SITEURL . 'admin/manage-admin.php');
    }


}
?>