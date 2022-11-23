<?php
//Opdracht 2
echo("<H1>Opdracht 2</H1>");
$currenthour = date("G");
$dagdeelvar = "";



switch($currenthour) {
    case $currenthour < 6 : $dagdeelvar = "nacht"; break;
    case $currenthour < 12 : $dagdeelvar = "ochtend"; break;
    case $currenthour < 18 : $dagdeelvar = "middag"; break;
    case $currenthour < 24 : $dagdeelvar = "avond"; break;
}
echo("<p>Het is " . $dagdeelvar . "</p>");


?>
