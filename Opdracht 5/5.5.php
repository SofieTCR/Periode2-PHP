<H1>Opdracht 5</H1>
<form action="" method="post">
    <input type="number" name="getal" placeholder="Vul een getal in...">
    <input type="submit" value="verzenden">
</form>


<?php
//Opdracht 5
if (isset($_POST['getal'])) {
    $getal = $_POST['getal'];
    $modulo = $getal % 2;
    if ($modulo == 1) {
        echo("<p>Het getal $getal is oneven.</p>");
    }
    else {
        echo("<p>Het getal $getal is even.</p>");
    }
}

?>