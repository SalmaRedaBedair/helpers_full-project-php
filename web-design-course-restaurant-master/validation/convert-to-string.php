<?php
function convert_to_string($conn,$input):string{
    $input=mysqli_real_escape_string($conn,$input);
    $input=trim($input);
    return $input;
}
?>