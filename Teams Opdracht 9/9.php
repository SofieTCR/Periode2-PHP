<?php
    function GetDB() {
        try {
            $MyDB = new PDO("mysql:host=localhost;dbname=bieren", "root", "");
            $query = $MyDB->prepare("SELECT naam, alcohol FROM bier");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            logOutput($result);
        } 
        catch(PDOException $e) {
            die("Error!: " . $e->getMessage());
        }
    }
    
    function logOutput($par) {
        echo("<table>");
        echo("<tr>");
            echo("<td>" . "Naam" . "</td>");
            echo("<td>" . "Alcohol" . "</td>");
        echo("</tr>");
        foreach ($par as $data) {
            echo("<tr>");
                echo("<td>" . $data["naam"] . "</td>");
                echo("<td>" . $data["alcohol"] . "</td>");
            echo("</tr>");
            
        }
        echo("</table>");
    }

    //main

    GetDB();
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