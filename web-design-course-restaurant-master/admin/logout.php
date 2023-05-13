<?php 
require_once('../config/constants.php');
session_destroy();
header('LOCATION:'.SITEURL.'admin/login.php');
?>