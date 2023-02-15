<?php
    try {
    $MyDB = new PDO("mysql:host=localhost;dbname=cijfers", "root", "");
    $query = $MyDB->prepare("SELECT * FROM cijfers");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo("<table>");
    echo("<tr> <td class=" . "HED LL" . ">Leerling</td> <td class=" . "HED CC" . ">Cijfer</td> </tr>");

    foreach ($result as $data) {
        echo("<tr>");
            echo("<td class=" . "LL" . ">" . $data["leerling"] . "</td>");
            echo("<td class=" . "CC" . ">" . $data["cijfer"] . "</td>");
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
    }
    .HED
    {
        font-weight: bold;
    }
    .LL
    {
        width: 150px;
    }
    .CC
    {
        width: 20px;
    }
</style>