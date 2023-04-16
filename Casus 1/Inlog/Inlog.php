<!DOCTYPE html>
<html lang="en">
<?php include("../Library/head.html"); ?>
<body>
    <?php include("../Library/menu.php"); ?>
    <!-- Page Code Goes Here --> 

    <main id="Inlog_Main">
        <div id="Inlog_Div">
            <form method="post" id="Login_Form">
                <div class="Inlog_Row"><label>Username: </label><input type="text" name="username" required></div><br>
                <div class="Inlog_Row"><label>Password: </label><input type="password" name="password" required></div><br>
                <input id="Inlog_Submit" type="submit" name="submit" value="Inloggen">
            </form>
            <?php
                if (isset($_POST["submit"])) {

                    // Enable the session if not already enabled
                    if (!isset($_SESSION)) {
                        session_start();
                    }

                    // Get the db ready.
                    $MyDB = GetDatabase("localhost", "root", "", "casus");
    
                    if ($MyDB != null) {
                        try {
                            // Start by checking if the Username exists in the database
                            $sql = "SELECT * FROM user WHERE user.username = '" . $_POST["username"] . "'";
                            $query = ExecuteQuerry($MyDB, $sql);
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            if (count($result) == 0) { // if there's no existing user, proceed. else, throw an error to the user
                                echo "Username is onjuist!";
                                exit;
                            }

                            // if we get to this point the username was accepted

                            // Start by checking if the Username exists in the database
                            $sql = "SELECT * FROM user WHERE user.username = '" . $_POST["username"] . "' AND user.password = '" . $_POST["password"] . "'";
                            $query = ExecuteQuerry($MyDB, $sql);
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            if (count($result) == 0) { // if there's no existing user, proceed. else, throw an error to the user
                                echo "Password is onjuist!";
                                exit;
                            }

                            $sql = "SELECT user.userid FROM user WHERE user.username = '" . $_POST["username"] . "'";

                            //echo $sql; // print the string to check its correct.

                            $query = ExecuteQuerry($MyDB, $sql);
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            //echo $result[0]["klantId"];

                            $_SESSION["userid"] = $result[0]["userid"];
                        
                            header("Location: ../Homepage/home.php");
                        }
                        catch (PDOException $th) {
                            Echo "Error: 403 Unable to read from the database! <br><br>" . $th;
                        }
                    }
                    else {
                        echo "Error! 401 Database not found!";
                    }
                }
            ?>
        </div>
    </main>

    <?php include("../Library/footer.html"); ?>
</body>
</html>