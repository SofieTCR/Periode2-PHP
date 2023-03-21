<?php
    // include all the functions
    include("functions.php");
    echo "Welcome to the editing page <br>";

    // Check if post was set
    if (isset($_POST["submit"])) {
        if ($_POST["submit"] == "Wijzig") {
            // We're editing the record
            $result = GetData($_POST["sqltable"]); // grab the table
            
            foreach ($result as $data) {
                if ($data[GetPrimaryKey($data)] == $_POST["id"]) {
                    // print the form
                    $form = "<form method=post>";
                    foreach (array_keys($data) as $dat) {
                        if ($dat != GetPrimaryKey($data)) {
                            $form .= $dat . "<input type=text name='" . $dat . "' value='" . $data[$dat] . "'><br>";
                        }
                    }
                    $form .= "<input type=hidden name=sqltable value=" . $_POST["sqltable"] . "><input type=hidden name=id value='" . $_POST["id"] . "'><input type=submit name=submit value=Wijzigen></form>";
                    echo $form;
                }
            }
        }
        else if ($_POST["submit"] == "Verwijder") {
            // We're deleting the record
            $result = GetData($_POST["sqltable"]); // grab the table
            foreach ($result as $data) {
                if ($data[GetPrimaryKey($data)] == $_POST["id"]) {
                    $result = $data;
                }
            }

            // Connect to the db
            $MyDB = ConnectDb();

            // Create the SQL string
            $sql = "DELETE FROM " . $_POST["sqltable"] . " WHERE " . array_keys($result)[0] . " = '" . $result[array_keys($result)[0]] . "'";

            //echo $sql; // echo the SQL statement for testing purposes
            //exit; // To stop the query from running while we're debugging

            try {
                $q = $MyDB->Prepare($sql);
                $q->Execute();

                header("Location: main_brouwers.php");
            } catch (PDOException $err) {
                Echo "Error encountered: " . $err;
            }            
        }
        else if ($_POST["submit"] == "Wijzigen") {
            // Change the actual data
            $result = GetData($_POST["sqltable"]); // grab the table
            foreach ($result as $data) {
                if ($data[GetPrimaryKey($data)] == $_POST["id"]) {
                    $result = $data;
                }
            }
            $resultkeys = array_keys($result);

            // Connect to the db
            $MyDB = ConnectDb();

            $sql = "UPDATE " . $_POST["sqltable"] . " SET ";
            // add all the update statements
            for ($i=1; $i < count($result); $i++) { 
                
                $sql .= $resultkeys[$i] . " = '" . $_POST[$resultkeys[$i]] . "'"; // add the column name plus requested value
                if ($i != count($result) - 1) {
                    $sql .= ", "; // add a comma if not the last one
                }
                else {
                    $sql .= " "; // don't add a comma if it is the last one
                }
            }

            //add the where clause
            $sql .= "WHERE " . $resultkeys[0] . " = '" . $result[$resultkeys[0]] . "'"; 

            //echo $sql; // echo the SQL statement for testing purposes
            //exit; // To stop the query from running while we're debugging

            try {
                $q = $MyDB->Prepare($sql);
                $q->Execute();

                header("Location: main_brouwers.php");
            } catch (PDOException $err) {
                Echo "Error encountered: " . $err;
            }
        }
    }
?>