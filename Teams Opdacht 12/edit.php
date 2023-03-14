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
                    //var_dump($data);
                    $form = "<form?>";
                    foreach (array_keys($data) as $dat) {
                        if ($dat != GetPrimaryKey($data)) {
                            $form .= $dat . "<input type=text value='" . $data[$dat] . "'><br>";
                        }
                    }
                    $form .= "<input type=submit value=Wijzigen></form>";
                    echo $form;
                }
            }
        }
        else if ($_POST["submit"] == "Verwijder") {
            // We're deleting the record
            echo "verwijderen";
        }
    }
?>