<?php
include_once("./classes.php");


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
        exit;
    }
}
$user = new User(GetDatabase("localhost", "root", "", "loginoop"));

if (!$user->IsLoggedIn()) {
    echo "Logged In";
    var_dump($user->getUserById($user->loggedInUser));
}
else {
    echo "not logged in";
}
?>