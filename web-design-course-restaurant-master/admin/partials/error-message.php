<?php
function message($name)
{
    if (isset($_SESSION["$name"])) {
        $msg = $_SESSION["$name"];
        echo "<p class='error-text'>*$msg</p>";
        unset($_SESSION["$name"]);
    }
}
?>