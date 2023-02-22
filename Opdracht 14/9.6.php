<form method="post" action="">
    <label>Naam</label>
    <input type="text" name="name"><br>
    <label>Bericht</label>
    <textarea rows="4" cols="40" name="text"></textarea><br>
    <input type="submit" name="submit" value="Versturen">
</form>



<?php
try {
    $MyDB = new PDO("mysql:host=localhost;dbname=Gastenboek", "root", "");
    
    if (isset($_POST['submit'])) {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);
        $query = $MyDB->prepare("INSERT INTO berichten(naam, bericht) VALUES('$name', '$text')");
        if ($query->execute()) {
            echo("Succesfully inserted the data");
        }
        else {
            echo("Error inserting data into DB");
        }
    }

    PrintData($MyDB);

} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}

function PrintData($par) {
    $query = $par->prepare("SELECT * FROM berichten");
    $query->execute();
    PrintResult($query->fetchAll(PDO::FETCH_ASSOC));
}

function PrintResult($par) {
    //print table
    if ($par == null) { return null; }
    echo "<table border=1px>";
    foreach (array_keys($par[0]) as $key) {
         echo "<td>" , $key;  "</td>";
    }
    foreach ($par as $data) {
        echo "<tr>";
        foreach (array_keys($data) as $dat) {
            echo "<td>" , $data [$dat];  "</td>";
        }
        echo "</tr>";
    }
    echo '"</table>';
 }

?>