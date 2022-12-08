<!-- HTML-formulier -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  Voer de straal van de cirkel in:
  <input type="text" name="radius" required><br>
  <input type="submit" value="Bereken omtrek en oppervlakte">
</form>

<?php
// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Haal de straal uit het formulier
  $radius = $_POST['radius'];

  // Bereken de omtrek en oppervlakte
  echo("De omtrek van een cirkel met straal $radius is: " . bereken_omtrek($radius) . "<br>");
  echo("De oppervlakte van een cirkel met straal $radius is: " . bereken_oppervlakte($radius));
}


// Functie om de omtrek te berekenen
function bereken_omtrek($radius) {
  return 2 * 3.14159 * $radius;
}

// Functie om de oppervlakte te berekenen
function bereken_oppervlakte($radius) {
  return 3.14159 * $radius * $radius;
}
?>