<?php
function session($message)
{
    if(isset($_SESSION["$message"]))
        {
            echo $_SESSION["$message"];
            unset($_SESSION["$message"]);
        }
}
?>