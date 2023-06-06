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
$databaseHost = "localhost";
$databaseUsername = "root";
$databasePassword = "";

SetGlobals();

include_once("./functions.php");

$state = GetState();

switch($state) {
    case "noDatabase":
        ShowDatabases();
        break;
    
    case "invalidDatabase":
        ShowDatabases();
        ShowError("Given Database was invalid, please reselect the Database");
        break;

    case "noTable":
        ShowTables();
        break;

    case "invalidTable":
        ShowTables();
        ShowError("Given Table was invalid, please reselect the Table");
        break;

    case "showCRUD":
        ShowCRUD();
        break;
    
}

function SetGlobals() {
    global $databaseHost, $databaseUsername, $databasePassword;
    if (!isset($_SESSION)) { session_start(); }
    $_SESSION["databaseHost"] = $databaseHost;
    $_SESSION["databaseUsername"] = $databaseUsername;
    $_SESSION["databasePassword"] = $databasePassword;
}

// if (!isset($_GET["database"])) {
//     // Database is not known, show options to select a database
//     $database = GetDatabase(srvname:"localhost", dbname:"", uname:"root", pword:"");
//     $options = ExecuteQuery(database:$database, query:"SHOW DATABASES;");

//     $optionButtons = generateButtonOptions(fieldname:"database", options:$options);

//     echo ("<form method=get>{$optionButtons}</form>");
// }
// else if (!isset($_GET["table"])) {
//     // table is not known, show options to select a table
//     $database = GetDatabase(srvname:"localhost", dbname:$_GET["database"], uname:"root", pword:"");
//     $temp = "sed;";
//     $temp2 = "klantldsf%^&$*(#();ere; drop tbales kdslfjlskjsfksdfklksdjf'l";
//     $temp3 = explode(";", $temp2)[0];
//     echo $temp3 . "<br>";
//     $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $temp3);
//     echo($tableName);
//     // $res = ExecuteQuery($database, "SELECT * FROM :klant", array("klant" => $temp2));
//     // $res = ExecuteQuery($database, "SELECT * FROM klant WHERE Voornaam = {$temp}");
//     // var_dump($res);
// }


?> 
</body>
</html>
