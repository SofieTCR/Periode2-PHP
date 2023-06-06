<?php
// variables
$databaseHost;
$databaseUsername;
$databasePassword;

try { // Try grabbing the connection information from the main file
    if (!isset($_SESSION)) { session_start(); }
    $databaseHost = $_SESSION["databaseHost"];
    $databaseUsername = $_SESSION["databaseUsername"];
    $databasePassword = $_SESSION["databasePassword"];
} catch (\Throwable $th) {
    ShowError("Could not load global variables");
}

function GetDatabase($srvname, $uname, $pword, $dbname)
{
    // Try Connecting to the database
    try {
        $db = new PDO("mysql:host=$srvname;dbname=$dbname", $uname, $pword);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } 
    catch(PDOException $e) {
        // Throw the error
        echo "{$e}";
        ShowError("Error connecting to Database");
        exit;
    }
}

function ExecuteQuery($database, $query, $paramArray = null)
{
    // Execute the Query on the given database
    $q = $database->prepare($query);

    $q->execute($paramArray);
    $q = $q->fetchAll(PDO::FETCH_ASSOC);
    return $q;
}

function ShowError($err) { // Show a JavaScript alert box with the issue at hand
    $quote = chr(34); // Define the " char to use in the JS alert
    echo "<script>alert({$quote}{$err}{$quote})</script>";
}

function GetState() { // This function returns the current state of the program which can be used to determine what to show on screen
    global $databaseHost, $databaseUsername, $databasePassword;
    if (!isset($_GET["database"])) { // Database checkouts
        return "noDatabase";
    }
    else { // In this case the Database does exist but we need to make sure it's valid
        $database = GetDatabase(srvname:$databaseHost, dbname:"", uname:$databaseUsername, pword:$databasePassword);
        $result = ExecuteQuery(database:$database, query:"SHOW DATABASES;");
        $database = null;
        $dblist = array();
        foreach ($result as $res => $value) {
            foreach ($result as $res) {
                foreach ($res as $value) {
                    $newvalue = explode(";", $value)[0];
                    $newvalue = preg_replace('/[^a-zA-Z0-9_]/', '', $newvalue);
                    array_push($dblist, $newvalue);
                }            
            }           
        }
        if (!in_array($_GET["database"], $dblist)) { return "invalidDatabase"; }
    }

    if (!isset($_GET["table"])) { // Table checkouts
        return "noTable";
    }
    else { // In this case the Table does exist but we need to make sure it's valid
        $database = GetDatabase(srvname:$databaseHost, dbname:$_GET["database"], uname:$databaseUsername, pword:$databasePassword);
        $result = ExecuteQuery(database:$database, query:"SHOW TABLES;");
        $database = null;
        $tblist = array();
        foreach ($result as $res) {
            foreach ($res as $value) {
                $newvalue = explode(";", $value)[0];
                $newvalue = preg_replace('/[^a-zA-Z0-9_]/', '', $newvalue);
                array_push($tblist, $newvalue);
            }            
        }
        if (!in_array($_GET["table"], $tblist)) { return "invalidTable"; }
    }

    return "showCRUD";
}

function ShowDatabases() {
    global $databaseHost, $databaseUsername, $databasePassword;
    $database = GetDatabase(srvname:$databaseHost, dbname:"", uname:$databaseUsername, pword:$databasePassword);
    $result = ExecuteQuery(database:$database, query:"SHOW DATABASES;");
    $database = null;

    $optionButtons = generateButtonOptions(fieldname:"database", options:$result, append:"<br>");

    echo ("<form method=get>{$optionButtons}</form>");
}

function ShowTables() {
    global $databaseHost, $databaseUsername, $databasePassword;
    $database = GetDatabase(srvname:$databaseHost, dbname:$_GET["database"], uname:$databaseUsername, pword:$databasePassword);
    $result = ExecuteQuery(database:$database, query:"SHOW TABLES;");
    $database = null;

    $optionButtons = generateButtonOptions(fieldname:"table", options:$result, append:"<br>");

    echo ("<form method=get><input type=hidden name=database value={$_GET["database"]}>{$optionButtons}</form>");
}

function ShowCrud($tableoptions = null) {
    global $databaseHost, $databaseUsername, $databasePassword;
    $database = GetDatabase(srvname:$databaseHost, dbname:$_GET["database"], uname:$databaseUsername, pword:$databasePassword);
    $sql = "SHOW COLUMNS FROM {$_GET["table"]}";
    $columns = ExecuteQuery(database:$database, query:$sql);

    $sql = "SELECT COLUMN_NAME AS 'Field', REFERENCED_COLUMN_NAME AS 'Ref_Field', REFERENCED_TABLE_NAME AS 'Ref_tb' FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = :tb AND CONSTRAINT_SCHEMA = :db AND REFERENCED_TABLE_NAME IS NOT NULL";
    $params = array("tb" => $_GET["table"], "db" => $_GET["database"]);
    $foreignkeys = ExecuteQuery(database:$database, query:$sql, paramArray:$params);

    var_dump($columns);
    var_dump($foreignkeys);
    exit;


    $sql = "SELECT * FROM {$_GET["table"]} WHERE 1";
    $params = array();
    $results = ExecuteQuery(database:$database, query:$sql, paramArray:$params);

    
    

    echo("<table class=CRUD_Table {$tableoptions}>{$lines}</table>");

}

function generateButtonOptions($fieldname, $options, $append = null) 
{
    // Returns string with for buttons with all options in the array
    $optionButtons = "";

    foreach ($options as $option) {
        foreach ($option as $opt) {
            $optionButtons .= "<input type=submit name={$fieldname} value={$opt}>{$append}";
        }
    }

    return $optionButtons;
}
?>