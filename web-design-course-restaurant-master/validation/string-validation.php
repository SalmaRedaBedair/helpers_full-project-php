<?php
require_once('convert-to-string.php');
function string_validation($conn,$string,$type):string
{
    $string=convert_to_string($conn,$string);
    $pattern = "/^[a-zA-Z\s]+$/"; // Only allow letters and spaces

    if(empty($string))
    {
        $_SESSION["$type"] = "$type is required.";
    }
    else if (!filter_var($string, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $pattern)))) {
        $type2=strtolower($type);
        $_SESSION["$type"] = "Invalid $type2 format.";
    }
    return $string;
}
?>
