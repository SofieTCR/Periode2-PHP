<?php
$output;

if (isset($_POST)) {
    $kapitaal = $_POST["StartKapitaal"];
    $rente = $_POST["RentePercentage"] / 100;
    $opname = $_POST["JaarlijkseOpname"];
    for ($i=0; $kapitaal >= $opname; $i++) { 
        $renteInkomst = $kapitaal * $rente;
        $kapitaal = $kapitaal - $opname + $renteInkomst;
        if ($i > 100) {
            break;
        }        
    }
    if ($i == 101) {
        $output = "U kunt uw hele leven € $opname opnemen,";
    }
    else {
        $output = "U kunt $i jaar lang € $opname opnemen.";
    }
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Opdracht 7</title>
</head>
<body>
    <H1>Opdracht 8</H1>
    <form action="" method="post">
        <label for="StartKapitaal">Startkapitaal</label>
        <input type="text" id="StartKapitaal" name="StartKapitaal" required><br>
        <label for="RentePercentage">Rentepercentage</label>
        <input type="text" id="RentePercentage" name="RentePercentage" required><br>
        <label for="JaarlijkseOpname">Jaarlijkse opname</label>
        <input type="text" id="JaarlijkseOpname" name="JaarlijkseOpname" required><br>
        <br>
        <input type="submit" name="submit" value="Bereken de looptijd">
    </form>
    <br><br><br>
    <p><?php echo $output; ?></p>
</body>
</html>