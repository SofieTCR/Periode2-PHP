<?php
// Functions


// Main
$string = $_SERVER["HTTP_USER_AGENT"];

echo($string . "<br>");
switch ($string) {
    case str_contains($string, "Chrome") : 
        echo "Google Chrome";
        break;
    case str_contains($string, "Edg") : 
        echo "Edge";
        break;
}
?>