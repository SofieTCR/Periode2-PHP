<?php

Function CRUDDisplay($db, $table) {
    $result = "<div style='display: flex; align-items: center; margin-bottom: 2vh;'><h2 class=CRUDDisplaytitle>CRUD " . $table . "</h2>";
    $result .= "<form method=post action=CRUD_Edit.php><input type=hidden name=table value=" . $table . "><input id=CRUDDisplaynew type=submit name=submit value='Add New'></form></div>";
    $result .= "<table border=1px id=CRUDDisplaytable><tr>";

    $sql = "SELECT * FROM " . $table;
    $query = ExecuteQuerry($db, $sql);
    $data =  $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SHOW KEYS FROM " . $table . " WHERE Key_name LIKE '%fk%' OR Key_name = 'Primary'";
    $query = ExecuteQuerry($db, $sql);
    $keydata =  $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SHOW COLUMNS FROM " . $table;
    $query = ExecuteQuerry($db, $sql);
    $keys =  $query->fetchAll(PDO::FETCH_ASSOC);    

    // Create headings
    foreach ($keys as $key) {
        $result .= "<td class=CRUDDisplaycolumn>" . $key["Field"];
        foreach ($keydata as $keytype) { // add labels for primary, foreign and AI keys.
            if ($keytype["Column_name"] == $key["Field"]) {
                if ($keytype["Key_name"] == "PRIMARY") {
                    $result .= " (PK)";
                }
                else {
                    $result .= " (FK)";
                }
                if ($key["Extra"] == "auto_increment") {
                    $result .= " (AI)";
                }
            }
        }
        $result .= "</td>";
    }
    $result .= "</tr>";

    // Fill in all the rows etc etc.
    foreach ($data as $dat) {
        $result .= "<tr class=CRUDDisplayrow>";
        $result .= "<form method=post action=CRUD_Edit.php> <input type=hidden name=table value='" . $table . "'>";

        foreach ($keys as $key) {
            $result .= "<td class=CRUDDisplaycolumn>" . $dat[$key["Field"]] . "</td>";
            foreach ($keydata as $keytype) {
                if ($keytype["Column_name"] == $key["Field"]) {
                    if ($keytype["Key_name"] == "PRIMARY") {
                        $result .= "<input type=hidden name=PK_" . $key["Field"] . " value='" . $dat[$key["Field"]] . "'>";
                    }
                }
            }
        }
        $result .= "<td><input class=CRUDDisplaysubmit type=submit value=Edit name=submit></td>";
        $result .= "<td class=CRUDDisplaycolumn> <input class=CRUDDisplaysubmit type=submit value=Delete name=submit> </td> </form>";
        $result .= "</tr>";
    }

    $result .= "</table>";
    echo $result;
}

function CRUDEdit($db, $table, $type, $pkarr) {
    //echo $type;
    if ($type == "Delete") {
        $sql = "DELETE FROM " . $table . " WHERE "; // start preparing the deletion query
        
        for ($i=0; $i < count($pkarr); $i++) { 
            $sql .= substr(array_keys($pkarr)[$i], 3) . " = '" . $pkarr[array_keys($pkarr)[$i]] . "'";
            if ($i != count($pkarr) - 1) {
                $sql .= " AND ";
            }
        }

        ExecuteQuerry($db, $sql); // execute the query
        $hdr = "<form method=post action='./CRUD.php' id=returnform><input type=hidden name=table value=" . $table . "></form><script>document.getElementById('returnform').submit();</script>";
        echo $hdr; // send the user back to the crud for this table page
    }
    else if ($type == "Update") {
        $sql = "SHOW COLUMNS FROM " . $table;
        $query = ExecuteQuerry($db, $sql);
        $keys =  $query->fetchAll(PDO::FETCH_ASSOC);
        
        $sql = "UPDATE " . $table . " SET ";
        
        foreach ($keys as $key) {
            $sql .= "" . $key["Field"];
            if ($_POST[$key["Field"]] != null) {
                $sql .= "='" . $_POST[$key["Field"]] . "'";
            }
            else {
                $sql .= "=" . "NULL";
            }
            if ($key != $keys[array_key_last($keys)]) {
                $sql .= ", ";
            }
        }

        $sql .= " WHERE ";

        for ($i=0; $i < count($pkarr); $i++) { 
            $sql .= substr(array_keys($pkarr)[$i], 3) . " = '" . $pkarr[array_keys($pkarr)[$i]] . "'";
            if ($i != count($pkarr) - 1) {
                $sql .= " AND ";
            }
        }

        ExecuteQuerry($db, $sql); // execute the query
        $hdr = "<form method=post action='./CRUD.php' id=returnform><input type=hidden name=table value=" . $table . "></form><script>document.getElementById('returnform').submit();</script>";
        echo $hdr; // send the user back to the crud for this table page
    }
    else if ($type == "Add") {
        $sql = "SHOW COLUMNS FROM " . $table;
        $query = ExecuteQuerry($db, $sql);
        $keys =  $query->fetchAll(PDO::FETCH_ASSOC);
        
        $sql = "INSERT INTO " . $table . " (";
        foreach ($keys as $key) {
            $sql .= $key["Field"];
            if ($key != $keys[array_key_last($keys)]) {
                $sql .= ", ";
            }
        }

        $sql .= ") VALUES (";

        foreach ($keys as $key) {
            if ($_POST[$key["Field"]] != null) {
                $sql .= "'" . $_POST[$key["Field"]] . "'";
            }
            else {
                $sql .= "NULL";
            }
            if ($key != $keys[array_key_last($keys)]) {
                $sql .= ", ";
            }
        }

        $sql .= ")";
        
        ExecuteQuerry($db, $sql); // execute the query
        $hdr = "<form method=post action='./CRUD.php' id=returnform><input type=hidden name=table value=" . $table . "></form><script>document.getElementById('returnform').submit();</script>";
        echo $hdr; // send the user back to the crud for this table page
    }
    else {
        //echo $type; // temp log to show which call executed this

        $sql = "SHOW COLUMNS FROM " . $table;
        $query = ExecuteQuerry($db, $sql);
        $keys =  $query->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SHOW KEYS FROM " . $table . " WHERE Key_name = 'Primary'";
        $query = ExecuteQuerry($db, $sql);
        $keydata =  $query->fetchAll(PDO::FETCH_ASSOC);

        $dbname = ExecuteQuerry($db, "SELECT DATABASE()")->fetchAll(PDO::FETCH_ASSOC)[0]["DATABASE()"];
        
        $sql = "SELECT COLUMN_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = '" . $table . "' AND CONSTRAINT_SCHEMA = '" . $dbname . "' AND REFERENCED_TABLE_NAME IS NOT NULL";
        $query = ExecuteQuerry($db, $sql);
        $fkkeydata =  $query->fetchAll(PDO::FETCH_ASSOC);

        $fkcollist = array();
        foreach ($fkkeydata as $keytype) {
            $sql = "SHOW COLUMNS FROM " . $keytype["REFERENCED_TABLE_NAME"];
            $query = ExecuteQuerry($db, $sql);
            $fkcollist[$keytype["COLUMN_NAME"]] = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($type == "Edit") { // get all the values that should be pre-inserted in case of edit
            $sql = "SELECT *  FROM " . $table . " WHERE "; // start preparing the query
        
            for ($i=0; $i < count($pkarr); $i++) { 
                $sql .= substr(array_keys($pkarr)[$i], 3) . " = '" . $pkarr[array_keys($pkarr)[$i]] . "'";
                if ($i != count($pkarr) - 1) {
                    $sql .= " AND ";
                }
            }

            $query = ExecuteQuerry($db, $sql);
            $values =  $query->fetchAll(PDO::FETCH_ASSOC);
        }

        $result = "<form method=post id=CRUD_Form>";

        $result .= "<input type=hidden name=table value=" . $table . ">";

        foreach ($keys as $key) {
            $isprimary = false;
            $field = "<div class=CRUD_Row><label>" . $key["Field"];
            foreach ($keydata as $keytype) { // Remove primary keys and add labels for AI keys.
                if ($keytype["Column_name"] == $key["Field"]) {
                    if ($keytype["Key_name"] == "PRIMARY") {
                        if ($type == "Edit") {
                            $isprimary = true;
                        }
                        else {
                            $field .= " (PK)";
                        }
                    }
                }

                if ($key["Extra"] == "auto_increment") {
                    $field .= " (AI)";
                }
            }
            foreach ($fkkeydata as $keytype) {
                if ($keytype["COLUMN_NAME"] == $key["Field"]) {
                    $field .= " (FK)";
                }
            }
            $field .= ": </label>";

            if (array_key_exists($key["Field"], $fkcollist) == false) {
                $field .= "<input type=";
                if ($key["Type"] == "date") {
                    $field .= "date";
                }
                else {
                    $field .= "text";
                }
                $field .= " name='" . $key["Field"] . "'";

                if ($key["Extra"] != "auto_increment" && $key["Null"] != "YES") {
                    $field .= " required";
                }

                if ($type == "Edit") { // insert the pre-existing value if we're in edit mode
                    $field .= " value='" . $values[0][$key["Field"]] . "'";
                }
            }
            else {
                $field .= "<select name='" . $key["Field"] . "'";

                if ($key["Extra"] != "auto_increment" && $key["Null"] != "YES") {
                    $field .= " required";
                }

                $field .= ">";

                foreach ($fkkeydata as $keytype) {
                    if ($key["Field"] == $keytype["COLUMN_NAME"]) {
                        $optiontype = null;
                        $sql = "SELECT " . $keytype["REFERENCED_COLUMN_NAME"];
                        foreach ($fkcollist[$keytype["COLUMN_NAME"]] as $refkeytype) {
                            if (stripos($refkeytype["Field"], "naam") !== false || stripos($refkeytype["Field"], "name") !== false) {
                                $optiontype = $refkeytype["Field"];
                            }
                        }
                        if ($optiontype != null) {
                            $sql .= ", " . $optiontype;
                        }
                        $sql .= " FROM " . $keytype["REFERENCED_TABLE_NAME"];
                        $query = ExecuteQuerry($db, $sql);
                        if ($type != "Edit" || $values[0][$keytype["COLUMN_NAME"]] == null) {
                            $field .= "<option";
                            if ($key["Null"] != "YES") {
                                $field .= " disabled";
                            }
                            $field .= " selected>Select " . $keytype["COLUMN_NAME"] . "</option>";
                        }
                        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $option) {
                            $field .= "<option value='" . $option[$keytype["REFERENCED_COLUMN_NAME"]] . "'";
                            if ($type == "Edit" && $option[$keytype["REFERENCED_COLUMN_NAME"]] == $values[0][$keytype["COLUMN_NAME"]]) {
                                $field .= " selected";
                            }
                            $field .= ">";
                            if ($optiontype != null) {
                                $field .= $option[$optiontype];
                            }
                            else {
                                $field .= $option[$keytype["REFERENCED_COLUMN_NAME"]];
                            }
                            $field .= "</option>";
                        }
                        

                    }
                }                

                $field .= "</select";
            }
            

            $field .= "></div><br>";

            if ($isprimary && $type == "Edit") {
                $result .= "<input type=hidden name=PK_" . $key["Field"] . " value='" . $values[0][$key["Field"]] . "'>";
                $result .= "<input type=hidden name=" . $key["Field"] . " value='" . $values[0][$key["Field"]] . "'>"; 
            }
            else {
                $result .= $field;
            }
        }

        $result .= "<input id=CRUD_Submit type=submit name=submit value=";
        if ($type == "Add New") {
            $result .= "Add";
        }
        else if ($type == "Edit") {
            $result .= "Update";
        }

        $result .= "></form>";

        echo $result;
    }
}

function GetPrimaryKeys($arr) {
    $pkarr = array_filter($arr, function($key) {
        return strpos($key, "PK_") === 0;
    }, ARRAY_FILTER_USE_KEY);
    return $pkarr;
}

function GetDatabase($srvname, $uname, $pword, $dbname)
{
    try {
        $db = new PDO("mysql:host=$srvname;dbname=$dbname", $uname, $pword);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $db;
    } 
    catch(PDOException $e) {

    }
}

function ExecuteQuerry($db, $query)
{
    $q = $db->prepare($query);
    $q->execute();
    return $q;
}

?>