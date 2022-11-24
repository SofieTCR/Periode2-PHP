<H1>Opdracht 6</H1>

<?php
//Opdracht 6
$uur = date("G");
$temperatuur = 18;
$luchtvochtigheid = 0.55;
if ($uur >= 17 || $temperatuur < 20 && $luchtvochtigheid < 0.85) {
    echo("<p>De airco is uit.</p>");
}
else {
    echo("<p>De airco is aan.</p>");
}
?>