<?php
//Opdracht 4
echo("<H1>Opdracht 4</H1>");
$prijs = 100;
$nieuweprijs;
$verhoging;
if ($prijs > 150) {
    $nieuweprijs = $prijs * 1.19;
    $verhoging = "19%";
}
elseif ($prijs < 55) {
    $nieuweprijs = $prijs * 1.11;
    $verhoging = "11%";
}
else {
    $nieuweprijs = $prijs * 1.16;
    $verhoging = "16%";
}
echo("<p>Oude prijs: € " . $prijs . ". Na verhoging van " . $verhoging . " is de prijs: € " . $nieuweprijs . "</p>");
?>