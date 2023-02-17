<?php

try{
    include("../Opdracht 9/8.3/databaseconnectie.php");
    if(isset($_POST['inloggen'])) {
        $username = filter_input(INPUT_POST, "username");
        $password = sha1($_POST['password']);
        $query = $MyDB->prepare("SELECT * FROM gebruikers WHERE username = '" . $username . "' AND password = '" . $password . "'");
        $query->execute();
        session_start();

        if($query->rowCount()==1){
            echo "Juiste gegevens!";
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['login'] = True;
            header('Location: Beveiligdepagina.php');
        } else{
            $_SESSION['username'] = "";
            $_SESSION['password'] = "";
            $_SESSION['login'] = False;
            echo "Onjuiste gegevens!";
        }
        echo "<br>";
    }
} catch(PDOException $e){
    die("Error!: " . $e->getMessage());
}

?>

<form method="post" action="">
    <label>Username</label>
    <input type="text" name="username"><br>
    <label>Password</label>
    <input type="password" name="password"><br>
    <input type="submit" name="inloggen" value="Inloggen">
</form>