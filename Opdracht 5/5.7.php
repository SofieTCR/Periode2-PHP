<H1>Opdracht 7</H1>
<form action="" method="post">
    <input type="number" name="geld" placeholder="Hoeveel spaargeld heb je?">
    <input type="submit" value="verzenden">
</form>


<?php
//Opdracht 5
if (isset($_POST['geld'])) {
    $geld = $_POST['geld'];
    $prijs = 1000;
    $tekort = $prijs - $geld;
    $overschot = $geld - $prijs;
    echo("<p>Je spaargeld is nu: $geld euro, ");
    switch($geld) {
        case $tekort > 250 : echo("je komt dus $tekort euro tekort! Je kan beter nog even een baantje gaan zoeken.</p>"); break;
        
        case $overschot >= 0 : echo("hiermee is het mogelijk om de iPhone te kopen! Je hebt nog $overschot euro over voor bijvoorbeeld een hoesje.</p>"); break;
        
        default : echo("je hebt bijna genoeg, maar er is nog $tekort euro te weinig.</p>"); break;
    }
}
?>