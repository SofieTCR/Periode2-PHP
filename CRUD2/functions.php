<?php
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
        $quote = chr(34); // Define the " char to use in the JS alert
        echo "{$e}";
        echo "<script>alert({$quote}Error connecting to Database{$quote})</script>";
        exit;
    }
}

function ExecuteQuery($database, $query, $paramArray = null)
{
    // Execute the Query on the given database
    $q = $database->prepare($query);

    if ($paramArray != null) {
        // $q->bindParams($paramArray);
    }
    $q->execute($paramArray);
    $q->execute();
    $q = $q->fetchAll(PDO::FETCH_ASSOC);
    return $q;
}


function generateButtonOptions($fieldname, $options) 
{
    // Returns string with for buttons with all options in the array
    $optionButtons = "";

    foreach ($options as $option) {
        foreach ($option as $opt) {
            $optionButtons .= "<input type=submit name={$fieldname} value={$opt}>";
        }
    }

    return $optionButtons;
}
?>