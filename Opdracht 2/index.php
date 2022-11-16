<?php

//  Een voorbeeld van een echo en een print
echo "<h1>Hallo wereld,</h1>";
echo "Ik zit op het ";

// Voorbeeld van een variabele in PHP.
$schoolnaam = "Techniek College Rotterdam !";
$opleiding = "Software Developer";

// Met echo kun je iets op het scherm tonen.
echo "$schoolnaam";

echo "<br>En ik doe de opleiding: " . $opleiding;


//Boek opdracht 1 H3 P6
echo "<br>Het is vandaag: " . date('l jS \of F Y');
echo "<br>Vandaag is het de " . date('z') . "e dag van het jaar.";
echo "<br>" . date('l') . " is de " . date('N') . "e dag van de week.";
echo "<br>De maand " . date('F') . " heeft in totaal " . date('t') . " dagen.";
echo "<br>Het jaar " . date('Y');
if (date('L') == 1) {
    echo " is een schrikkeljaar.";
}
else {
    echo " is geen schrikkeljaar.";
}
?>