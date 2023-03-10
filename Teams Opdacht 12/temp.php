<?php
    echo "Welcome to the editing page <br>";
    if (isset($_POST["submit"])) {
        echo "Received ID: " . $_POST["id"] . "<br>";
        echo "Received Method: " . $_POST["submit"] . "<br>";
    }

?>