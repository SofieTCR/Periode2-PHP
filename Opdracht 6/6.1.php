<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
</head>
<body>
<?php
    session_start();
    if(isset($_SESSION["Counter"])) {
        $_SESSION["Counter"]++;
    }
    else {
        $_SESSION["Counter"] = 1;
    }
    echo("<p>U heeft deze pagina ". $_SESSION["Counter"]. " keer bekeken.</p>");
?>
</body>
</html>