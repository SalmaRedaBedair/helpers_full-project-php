<?php
require_once('../config/constants.php');
foreach (glob("../validation/*.php") as $filename) {
    require_once $filename;
}
?>
<html>

<head>
    <title>
        login
    </title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/message.css">
</head>

<body class="background">
    <div class="login text-center">
        <h1>Login</h1>
        <br />
        <?php
        session('login');
        session('login-check');
        ?>
        <br /><br />
        <form action="" method="POST">
            User Name:
            <input type="text" name="user_name" placeholder="Enter your username">
            <?php
            message('Username');
            ?>
            <br /><br />
            Password:
            <input type="password" name="password" placeholder="Enter your password">
            <?php
            message('password');
            ?>
            <br /><br />
            <input type="submit" class="btn-secondary" name="login" value="login">
        </form>
        <br />
        <p>created by <a href="#" class="link">loma</a>
        </p>
    </div>
</body>

</html>
<?php
if (isset($_POST['login'])) {
    $username = string_validation($conn, $_POST['user_name'], "Username");
    $password = password_validation($conn, $_POST['password']);
    $password = md5($password);

    if (isset($_SESSION['Username']) || isset($_SESSION['password'])) {
        header('LOCATION:' . SITEURL . 'admin/login.php');
        exit();
    }


    $sql = "SELECT * FROM `tbl_admin` WHERE `user_name`='$username' AND `password`='$password'";
    $res = $conn->query($sql);
    if (mysqli_num_rows($res) >= 1) {
        $_SESSION['user'] = $username;
        $_SESSION['login'] = "<div class='success'>login successfully</div>";
        header('LOCATION:' . SITEURL . 'admin/index.php');
    } else {
        $_SESSION['login'] = "<div class='error'>username or password don't match</div>";
        header('LOCATION:' . SITEURL . 'admin/login.php');
    }
}
?>