<?php
require_once('convert-to-string.php');
function phone_validation($conn,$phone)
{
    $phone=convert_to_string($conn,$phone);
    if(empty($phone))
    {
        $_SESSION['phone'] = "phone is required.";
    }
    if (!preg_match("/^\+20\d{10}$/", $phone)) {
        $_SESSION['phone'] = "Invalid phone number";
    }
    return $phone;
}
?>
