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

  // De constante pi
  define("PI", 3.14159);

  // Functie om de omtrek te berekenen
  function bereken_omtrek($radius) {
    return 2 * PI * $radius;
  }

  // Functie om de oppervlakte te berekenen
  function bereken_oppervlakte($radius) {
    return PI * $radius * $radius;
  }

  // Bereken de omtrek en oppervlakte
  $circumference = bereken_omtrek($radius);
  $area = bereken_oppervlakte($radius);

 
?>