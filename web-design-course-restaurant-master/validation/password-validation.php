<?php
function password_validation($conn,$password,$type="password")
{
    $password=mysqli_real_escape_string($conn,$password);
    if(empty($password)||!isset($password))
    {
        $_SESSION["$type"] = "Password is required.";
    }
    return $password;
}
?>