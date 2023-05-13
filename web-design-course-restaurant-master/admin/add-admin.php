<?php include_once("partials/menu.php") ?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>

        <?php
        session('add');
        ?>

        <br /><br />

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" placeholder="Enter your name" name="fullname">
                        <?php
                        message("Name");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" class="username" placeholder="Your username" name="username">
                         <?php
                        message("Username");
                        ?>

                    </td>
                </tr>

                <tr>
                    <td>password: </td>
                    <td>
                        <input type="password" class="password" placeholder="Your password" name="password">
                        <?php
                        message("password");
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn-secondary" value="Add Admin" name="submit">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<!-- manin-content section ends -->

<?php include_once("partials/footer.php") ?>

<?php
if (isset($_POST['submit'])) {
    $full_name = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_validation($conn, $password);
    $password = md5($password); // password encription with md5


    $full_name = string_validation($conn, $full_name, "Name");
    $username = string_validation($conn, $username, "Username");


    // echo $full_name.$username.$password;
    if (isset($_SESSION['Name']) || isset($_SESSION['Username']) || isset($_SESSION['password'])) {
        header('LOCATION:' . SITEURL . 'admin/add-admin.php');
        exit();
    } else {
        $sql = "INSERT INTO `tbl_admin`(`full_name`, `user_name`, `password`) VALUES ('$full_name','$username','$password')";

        if ($conn->query($sql)) {
            $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
            header('LOCATION: ' . SITEURL . 'admin/manage-admin.php');
            exit();
        } else {
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
            header('LOCATION: ' . SITEURL . 'admin/add-admin.php');
            exit();
        }
    }
}
?>