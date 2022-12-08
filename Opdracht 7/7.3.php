<H1>Opdracht 7</H1>
<form action="" method="post">
    <input type="radio" name="colour" id="red" value="red" checked="checked">
    <label for="Optellen">Red</label>
    <input type="radio" name="colour" id="green" value="green" >
    <label for="Aftrekken">Green</label>
    <input type="radio" name="colour" id="blue" value="blue" >
    <label for="Vermenigvuldigen">Blue</label>
    <input type="radio" name="colour" id="purple" value="purple" >
    <label for="Delen">Purple</label>
    <br>
    <br>
    <input type="submit" value="Instellen">
</form>


<?php
//Opdracht 7
if (isset($_POST['colour'])) {
    $colour = $_POST['colour'];
    echo("<style>
        body{
            background-color: $colour;
        }
    </style>");
}
?>