<H1>Opdracht 7</H1>
<form action="" method="post">
    <label for="getal1">Prijs</label>
    <input type="number" name="getal1" placeholder="Vul een getal in..." required>
    <br>
    <label for="getal2">Korting (%)</label>
    <input type="number" name="getal2" placeholder="Vul een getal in..." required>
    <br>
    <br>
    <input type="submit" value="Uitrekenen">
</form>


<?php
//Opdracht 7
if (isset($_POST['getal1'])) {
    $getal1 = $_POST['getal1'];
    $getal2 = $_POST['getal2'];
    $result = number_format($getal1 * (1 - $getal2 / 100), 2, ",", ".");
    
    echo("<br><br>Bedrag inclusief $getal2% korting: €$result");
}
?>