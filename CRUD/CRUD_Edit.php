<!DOCTYPE html>

<body>
    <?php include("./Functions.php"); ?>

    <?php
        $MyDB = GetDatabase("localhost", "root", "", "bieren");

        if(isset($_POST["submit"])) {
            CRUDEdit($MyDB, $_POST["table"], $_POST["submit"], GetPrimaryKeys($_POST)); // Call the editing page
        }
        else {
            header("Location: ./CRUD.php");
        }
    ?>

</body>
</html>
