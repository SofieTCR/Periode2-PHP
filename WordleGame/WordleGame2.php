<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style.css">
    <title>Wordle Algorithm</title>
</head>
<body>
    <form method="post">
        <label for="CharCount">Aantal Letters: </label>
        <input type="number" name="CharCount" id="CharCount" min="1" max="11" value="5" onchange="valuechanged()"> <br>
        <div id="CorrectChars"></div>
        <script>
            function valuechanged() {
                var printstr = "Correct Chars:";
                for (let index = 0; index < document.getElementById("CharCount").value; index++) {
                    printstr = printstr + "<input maxlength=" + String.fromCharCode(34) + "1" + String.fromCharCode(34) + "type=" + String.fromCharCode(34) + "text" + String.fromCharCode(34) + "id=" + String.fromCharCode(34) + index + String.fromCharCode(34) + "class=" + String.fromCharCode(34) + "CorrectLettersInput" + String.fromCharCode(34) + ">";
                    
                }
                document.getElementById("CorrectChars").innerHTML = printstr;   
            }
            valuechanged();
        </script>
    </form>
    <?php 

    ?>
</body>
</html>