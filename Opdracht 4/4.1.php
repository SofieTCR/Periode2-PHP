<?php
//Opdracht 1
echo("<H1>Opdracht 1</H1>");
$currenthour = date("G");
$dagdeelvar = "";

if ($currenthour < 6) {
    $dagdeelvar = "nacht";
}
elseif ($currenthour < 12) {
    $dagdeelvar = "ochtend";
}
elseif ($currenthour < 18) {
    $dagdeelvar = "middag";
}
elseif ($currenthour < 24) {
    $dagdeelvar = "avond";
}
echo("<p>Het is " . $dagdeelvar . "</p>");


?>