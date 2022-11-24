<H1>Opdracht 8</H1>
<H1>Leeftijd voor scooterrijbewijs en om te stemmen</H1>
<form action="" method="post">
    <input type="number" name="leeftijd" placeholder="Wat is je leeftijd?">
    Stempas ontvangen?
    <input type="radio" name="stempas" value="true">Ja (true)
    <input type="radio" name="stempas" value="false" checked="checked">Nee (false)
    <input type="submit" value="verzenden">
</form>


<?php
//Opdracht 5
if (isset($_POST['leeftijd'])) {
    $leeftijd = $_POST['leeftijd'];
    $stempas = $_POST['stempas'];
    if ($leeftijd >= 16) {
        echo("<p>Je mag praktijkexamen voor je scooterrijbewijs doen.</p>");
    }
    else {
        echo("<p>Je mag geen praktijkexamen voor je scooterrijbewijs doen.</p>");
    }
    switch($leeftijd) {
        case $leeftijd >= 18 && $stempas == "true": echo("<p>Je mag stemmen, want je bent (ouder dan) 18 en hebt een stempas.</p>"); break;

        case $leeftijd >= 18 &&  $stempas == "false": echo("<p>Je mag niet stemmen, went je bent (ouder dan) 18 maar je hebt geen stempas.</p>"); break;

        case $leeftijd < 18 && $stempas == "true":  echo("<p>Je mag niet stemmen, went je bent nog geen 18. Ookal heb je een stempas.</p>"); break;

        default :  echo("<p>Je mag niet stemmen, went je bent nog geen 18. En je hebt geen stempas.</p>"); break;
    }
}
?>