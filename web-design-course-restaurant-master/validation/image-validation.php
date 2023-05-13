<?php 
require_once("convert-to-string.php");
function image_validation($conn,$filename,$type="image"):string
{
    $filename=convert_to_string($conn,$filename);
    $pattern = '/^[\w\-.]+\.(jpg|jpeg|png|gif)$/i'; // regular expression pattern
    if(!preg_match($pattern, $filename)) {
        // if the filename does not match the pattern, return an error message
        $_SESSION["$type"]= "Invalid image file name. Allowed extensions are: jpg, jpeg, png, gif";
    }
    return $filename;
}
?>