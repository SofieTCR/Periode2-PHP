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
    $cookie_name = "TotalVisits";
    $cookie_value = 1;    
    if(isset($_SESSION["Counter"])) {
        $_SESSION["Counter"]++;
    }
    else {
        $_SESSION["Counter"] = 1;
    }
    if(!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/");
    }
    else {
        $cookie_value = $_COOKIE[$cookie_name] + 1;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/");
    }
    echo("<p>U heeft deze pagina deze sessie ". $_SESSION["Counter"]. " keer bekeken.</p>");
    echo("<p>U heeft deze pagina in totaal ". $_COOKIE["TotalVisits"]. " keer bekeken.</p>");

?>
</body>
</html>