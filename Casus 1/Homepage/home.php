<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>
    <!-- Page Code Goes Here --> 
    <main id="Homepage_Main">
    <?php
        $db = GetDatabase("localhost", "root", "", "casus");
        $table = "melding";

        $result = "<div style='display: flex; align-items: center; margin-bottom: 2vh;'>";
        $result .= "</div>";
        $result .= "<table id=Systeembeheer_CRUDDisplaytable><tr>";
    
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
            $result .= "<td class=Systeembeheer_CRUDDisplaycolumn>" . $key["Field"];
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
            $result .= "<tr class=Systeembeheer_CRUDDisplayrow>";
    
            foreach ($keys as $key) {
                $result .= "<td class=Systeembeheer_CRUDDisplaycolumn>" . $dat[$key["Field"]] . "</td>";
            }
           $result .= "</tr>";
        }
    
        $result .= "</table>";
        echo $result;
    ?>
    </main>
    <?php include("../Library/footer.html"); ?>
</body>
</html>