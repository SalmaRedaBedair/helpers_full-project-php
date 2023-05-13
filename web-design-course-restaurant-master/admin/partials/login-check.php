<?php
if(!isset($_SESSION['user']))
{
    $_SESSION['login-check']="<div class='error'>please, login first!</div>";
    header('LOCATION:'.SITEURL.'admin/login.php');
}
?>