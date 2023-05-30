
<!DOCTYPE html>
<body>
    <?php
        // Made By: Sofie Brink
        include("./Functions.php");

        $MyDB = GetDatabase("localhost", "root", "", "3dplus");

        if (isset($_POST["table"])) {
            CRUDDisplay($MyDB, $_POST["table"]); // Print all the stuff in the table
        }
        else {
            $selection = "<form method=post><h3>Select table:</h3>";

            $sql = "SHOW TABLES";
            $query = ExecuteQuerry($MyDB, $sql);
            $data =  $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $dat) {
                $selection .= "<input type=submit name=table value='" . $dat[array_keys($dat)[0]] . "'>";
            }

            $selection .= "</form>";
            echo ($selection);
        }
    ?>
</body>
</html>

