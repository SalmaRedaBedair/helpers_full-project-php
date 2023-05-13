<?php require_once('../config/constants.php');
require_once('partials/login-check.php');
require_once('partials/error-message.php');
foreach (glob("../validation/*.php") as $filename) {
    require_once $filename;
}
?>
<html>
    <head>
        <title>
            Food Order Website
        </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/message.css">
    </head>
    <body>
        <!-- menu section starts -->
        <div class="menu text-center">
            <div class="wrapper">
            <ul>
                <li><a href="index.php" class="link">Home</a></li>
                <li><a href="manage-admin.php" class="link">Admin</a></li>
                <li><a href="manage-category.php" class="link">Category</a></li>
                <li><a href="manage-food.php" class="link">food</a></li>
                <li><a href="manage-order.php" class="link">Order</a></li>
                <li><a href="logout.php" class="link">Logout</a></li>
            </ul>
            </div>
        </div>
        <!-- menu section ends -->