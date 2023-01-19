<!DOCTYPE html>
<html>
<head>
    <title>Opdracht 7</title>
</head>
<body>
    <H1>Opdracht 8</H1>
    <form action="" method="post">
        <label for="Fruitsoort">Fruitsoort: </label>
        <input type="text" id="Fruitsoort" name="Fruitsoort"><br>
        <br>
        <input type="submit" name="submit" value="Toevoegen"><br>
        <br>
        --------------------
        <br>
        <input type="submit" name="submit" value="Sorteren">
        <input type="submit" name="submit" value="Schudden"><br>
        <br>
        --------------------
    </form>
    <br><br><br>
</body>
</html>

<?php
session_start();

// Check if the session variable for the array is set
if (!isset($_SESSION["soorten"])) {
    // If not, initialize it as an empty array
    $_SESSION["soorten"] = array();
}

if (isset($_POST)) {
    $soort = $_POST["Fruitsoort"];
    $action = $_POST["submit"];
    switch ($action) {
        case "Toevoegen":
            if (!empty($soort)) {
                $_SESSION["soorten"][] = $soort;
            }
            break;
        case "Schudden":
            shuffle($_SESSION["soorten"]);
            break;
        case "Sorteren":
            sort($_SESSION["soorten"]);
            break;
        default:
            break;
    }
}
for ($i=0; $i < count($_SESSION["soorten"]); $i++) { 
    echo($_SESSION["soorten"][$i] . "<br>");
    
}
?>
