<?php
// auteur: Wigmans
// functie: algemene functies tbv hergebruik
 function ConnectDb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bieren";
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

 }

 function GetData($table){
    // Connect database
    $conn = ConnectDb();

    // Select data uit de opgegeven table
    $query = $conn->prepare("SELECT * FROM $table");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
 }

 function OvzBieren() {
    // haal alle brouwer records uit de database
    $wantedtable = "bier";
    $result = GetData($wantedtable);

    //PrintResult($result);
    CRUDDisplay($result, $wantedtable);
 }

 function OvzBrouwers() {
    // haal alle brouwer records uit de database
    $wantedtable = "brouwer";
    $result = GetData($wantedtable);

    //PrintResult($result);
    CRUDDisplay($result, $wantedtable);
 }

 function CRUDDisplay($par, $sqltable) {
   $table = "";
   //print table
   $table .= "<table border=1px>";
   foreach (array_keys($par[0]) as $key) {
        $table .= "<td>" . $key . "</td>";
   }

   foreach ($par as $data) {
       $table .= "<tr>";
       foreach (array_keys($data) as $dat) {
           $table .= "<td>" . $data [$dat] . "</td>";
       }
       $table .= "<form method=post action=edit.php> <td> <input type=hidden name=sqltable value=" . $sqltable . "><input type=hidden name=id value=" . $data[GetPrimaryKey($data)] . "><input type=submit value=Wijzig name=submit></td>";
       $table .= "<td> <input type=submit value=Verwijder name=submit> </td> </form>";
       $table .= "</tr>";
   }
   $table .= "</table>";

   echo $table;
 }

 function GetPrimaryKey($par) {
   return array_keys($par)[0];
 }

 function PrintResult($par) {
    //print table
   echo "<table border=1px>";
   foreach (array_keys($par[0]) as $key) {
        echo "<td>" . $key . "</td>";
   }

   foreach ($par as $data) {
       echo "<tr>";
       foreach (array_keys($data) as $dat) {
           echo "<td>" . $data [$dat] . "</td>";
       }
       echo "</tr>";
    }
    echo '"</table>';
 }

?>