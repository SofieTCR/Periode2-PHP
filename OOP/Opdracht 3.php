<?php
class Product
{
    public $name;
    public $price;
    public $catagory;

    public function FormatPrice() {
        return number_format($this->price, 2, ",", ".");
    }
}

$game1 = new Product();
$game1->name = "Kerbal Space Program";
$game1->price = 30;
$game1->catagory = "Simulation";

PrintObject($game1);
echo $game1->FormatPrice();

function PrintObject($obj) {
    $objarr = get_object_vars($obj);
    for ($i=0; $i < count($objarr); $i++) { 
        echo (array_keys($objarr)[$i] . " : " . $objarr[array_keys($objarr)[$i]] . "<br>"); 
    }
}
?>