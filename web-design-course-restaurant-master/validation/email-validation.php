<?php
require_once('convert-to-string.php');
function email_validation($conn,$email)
{
    $email=convert_to_string($conn,$email);
    if(empty($email))
    {
        $_SESSION['email'] = "Email is required.";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email'] = "Invalid email format.";
    }
    return $email;
}
?>
