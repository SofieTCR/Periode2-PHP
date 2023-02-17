<?php
    try {
    include("../Opdracht 9/8.3/databaseconnectie.php");
    $password = sha1('geheim');
    $query = $MyDB->prepare("INSERT INTO gebruikers(username, password) VALUES('ik', '" . $password . "')");
    if ($query->execute()) {
        echo("Succesfully inserted the data");
    }
    else {
        echo("Error inserting data into DB");
    }
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}

?>