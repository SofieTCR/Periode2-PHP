<?php
class Product
{
    public $name;
    public $price;
    public $catagory;
}

$game1 = new Product();
$game1->name = "Kerbal Space Program";
$game1->price = 30;
$game1->catagory = "Simulation";

PrintObject($game1);
$game1->price = 20;
PrintObject($game1);

function PrintObject($obj) {
    $objarr = get_object_vars($obj);
    for ($i=0; $i < count($objarr); $i++) { 
        echo (array_keys($objarr)[$i] . " : " . $objarr[array_keys($objarr)[$i]] . "<br>"); 
    }
}
?>