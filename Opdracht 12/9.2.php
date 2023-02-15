<?php
    try {
    include("../Opdracht 9/8.3/databaseconnectie.php");
    $query = $MyDB->prepare("SELECT * FROM fietsen");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $data) {
        echo "<a href='detail.php?id=" . $data['id'] . "'>";
        echo $data['merk'] . " " . $data["type"];
        echo "</a>" . "<br>";        
    }
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}

?>