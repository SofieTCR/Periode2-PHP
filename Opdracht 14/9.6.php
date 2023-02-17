<form method="post" action="">
    <label>Naam</label>
    <input type="text" name="name"><br>
    <label>Bericht</label>
    <textarea rows="4" cols="40" name="text"></textarea><br>
    <input type="submit" value="Versturen">
</form>



<?php
    try {
    if (isset($_POST)) {
        $MyDB = new PDO("mysql:host=localhost;dbname=Gastenboek", "root", "");
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);
        $query = $MyDB->prepare("INSERT INTO berichten(naam, bericht) VALUES('$name', '$text')");
        if ($query->execute()) {
            echo("Succesfully inserted the data");
        }
        else {
            echo("Error inserting data into DB");
        }
        unset($_POST);
    }
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}

?>