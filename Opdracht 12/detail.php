<?php
    try {
    include("../Opdracht 9/8.3/databaseconnectie.php");
    $query = $MyDB->prepare("SELECT * FROM fietsen where id = " . $_GET['id']);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $data) {
        echo("Artikelnummer: " . $data['id'] . "<br>");   
        echo("Merk: " . $data['merk'] . "<br>");   
        echo("Type: " . $data['type'] . "<br>");   
        echo("Prijs:  &euro; " . number_format($data["prijs"], 2, ",", ".")  . "<br><br>");   
    }
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}

?>
<a href="./9.2.php">Terug naar de master pagina</a>