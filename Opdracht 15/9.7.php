<?php
function ConnectDb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gastenboek";

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

function MakePoll($pollid) {
    //make the connection with the database
    $MyDB = ConnectDb();

    //get the query ready
    $query = $MyDB->prepare("SELECT * FROM poll WHERE poll.id = $pollid");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    //print the question and open the form
    //var_dump($result);
    echo ($result[0]["vraag"] . "<br> <form method=" . "post" . ">");

    //get all the options for this poll
    $query = $MyDB->prepare("SELECT * from optie WHERE optie.pollid = $pollid");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC); 
    
    //print all the options for the poll
    //var_dump($result);
    foreach ($result as $data) {
        echo ("<input type=" . "radio" . " name=" . "optie" . " value=" . $data["id"] . " required> ");
        echo ($data["optie"] . "<br>");
    }

    //Add the submit button and close the form
    echo ("<input type=" . "submit" . " name=" . "submit" . " value=" . "Versturen" . "></form>"); 
}

function SubmitResult($optionid) {
    // Make the connection with the database
    $MyDB = ConnectDb();

    // Get the query ready
    $query = $MyDB->prepare("SELECT * FROM optie WHERE optie.id = $optionid");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    // Add 1 to the vote count
    $votes = $result[0]["stemmen"];
    $votes++;

    // Update the Database
    $query = $MyDB->prepare("UPDATE optie SET stemmen = $votes WHERE optie.id = $optionid");
    $query->execute();
}

MakePoll(1);
if (isset($_POST["submit"])) {
    //Send the result of the poll to the database
    SubmitResult($_POST["optie"]);
}
?>