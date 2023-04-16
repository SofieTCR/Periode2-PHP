<header>

<ul class="ul_menu">
    <p class="p_menulogo">De Regenboog</p>
    <li class="menu_li"><a href="../Homepage/home.php">Home</a></li>

    <?php
        // Include the db functions
        include("../Library/Database_Functions.php");
        include("../Systeembeheerder/Systeembeheer_Functions.php");
        
        // Enable the session if not already enabled
        if (!isset($_SESSION)) {
            session_start();
        }
        
        // Check if you're logged in by checking the existence of a user id. 
        if (isset($_SESSION["userid"])) {
            echo "<li class=menu_li><a OnClick='DoPopup()'>Melding Maken</a></li>";
            echo "<li class=menu_li><a href=../Inlog/Uitlog.php>Uitloggen</a></li>";
            try {
                if (CheckAdministrator()) {
                    echo "<li class=menu_li><a href=../Systeembeheerder>Beheer</a></li>";
                }
                if (isset($_POST['reason'])) {
                    $MyDB = GetDatabase("localhost", "root", "", "casus");
        
                    $sql = "INSERT INTO melding (userid, reden) VALUES ('" . $_SESSION["userid"] . "', '" . $_POST["reason"] . "')";

                    $query = executeQuerry($MyDB, $sql);

                    header("location: ../Homepage/home.php");
                }
            } catch (PDOException $th) {
                //throw $th;
            }

            echo "<form method=post id=jssubmitform></form><script>function DoPopup() { var form = document.getElementById('jssubmitform'); var input = prompt('Reden Absentie: '); form.innerHTML = '<input type=hidden name=reason value=' + String.fromCharCode(34) + input.replace(String.fromCharCode(34), '') + String.fromCharCode(34) + '>'; form.submit(); }</script>";
        }
        else {
            echo "<li class=menu_li><a href=../Inlog/Inlog.php>Login</a></li>";
        }

        

    ?>
</ul>
</header>
