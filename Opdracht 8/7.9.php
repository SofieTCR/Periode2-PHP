<!DOCTYPE html>
<html>
<head>
    <title>Opdracht 7</title>
</head>
<body>
    <H1>Opdracht 8</H1>
    <form action="" method="post">
        <label for="Tekst">Tekst: </label>
        <input type="text" id="Tekst" name="Tekst" required><br>
        <input type="radio" name="type" value="Capitalised">
        <label for="Capitalised">In hoofdletters</label><br>
        <input type="radio" name="type" value="NonCapitalised">
        <label for="NonCapitalised">In kleine letters</label><br>
        <input type="radio" name="type" value="FirstCapitalised">
        <label for="FirstCapitalised">Eerste letter van zin hoofdletter</label><br>
        <input type="radio" name="type" value="AllFirstCapitalised">
        <label for="Capitalised">Eerste letter van ieder woord hoofdletter</label><br>
        <input type="submit" name="submit" value="Weergeven">
    </form>
    <br><br><br>
</body>
</html>

<?php

if (isset($_POST) && isset($_POST["type"])) {
    switch ($_POST["type"]) {
        case "Capitalised":
            echo(strtoupper($_POST["Tekst"]));
            break;
        case "NonCapitalised":
            echo(strtolower($_POST["Tekst"]));
            break;
        case "FirstCapitalised":
            echo(ucfirst(strtolower($_POST["Tekst"])));
            break;
        case "AllFirstCapitalised":
            echo(ucwords(strtolower($_POST["Tekst"])));
            break;
        
    }
}

?>
