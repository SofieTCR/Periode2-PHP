<?php
    try {
    include("../Opdracht 9/8.3/databaseconnectie.php");
    $query = $MyDB->prepare("SELECT * FROM fietsen");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo("<table>");
    foreach ($result as $data) {
        echo("<tr>");
            echo("<td>" . $data["merk"] . "</td>");
            echo("<td>" . $data["type"] . "</td>");
            echo("<td>&euro;" . number_format($data["prijs"], 2, ",", ".") . "</td>");
        echo("</tr>");
        
    }
    echo("</table>");
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}

?>

<style>
    table {
        border-collapse: collapse;
        border: 1px solid black;
    }
    td {
        border: 1px solid black;
        width: 100px;
    }
</style>