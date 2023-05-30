<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
<?php
$database;
$table;

include_once("./functions.php");

if (!isset($_GET["database"])) {
    // Database is not known, show options to select a database
    $database = GetDatabase(srvname:"localhost", dbname:"", uname:"root", pword:"");
    $options = ExecuteQuery(database:$database, query:"SHOW DATABASES;");

    $optionButtons = generateButtonOptions(fieldname:"database", options:$options);

    echo ("<form method=get>{$optionButtons}</form>");
}
else if (!isset($_GET["table"])) {
    // table is not known, show options to select a table
    $database = GetDatabase(srvname:"localhost", dbname:$_GET["database"], uname:"root", pword:"");
    $temp = "sed;";
    $temp2 = "klant";
    $res = ExecuteQuery($database, "SELECT * FROM :klant", array("klant" => $temp2));
    // $res = ExecuteQuery($database, "SELECT * FROM klant WHERE Voornaam = {$temp}");
    var_dump($res);
}


?> 
</body>
</html>
