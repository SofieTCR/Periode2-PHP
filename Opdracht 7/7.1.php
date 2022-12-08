<H1>Opdracht 7</H1>
<form action="" method="post">
    <label for="getal">Bedrag exclusief BTW</label>
    <input type="number" name="getal" placeholder="Vul een getal in..." required>
    <br>
    <input type="radio" name="percent" id="Laag" value="9" checked="checked">
    <label for="Laag">Laag, 9%</label>
    <br>
    <input type="radio" name="percent" id="Hoog" value="21">
    <label for="Hoog">Hoog, 21%</label>
    <br>
    <input type="submit" value="Uitrekenen">
</form>


<?php
//Opdracht 7
if (isset($_POST['getal'])) {
    $bedrag = $_POST['getal'];
    $procent = $_POST['percent'];

    $resultaat = number_format($bedrag * (1 + $procent / 100), 2, ",", ".");
    echo("Bedrag inclusief $procent BTW: €" . $resultaat);
}

?>