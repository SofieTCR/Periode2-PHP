<?php
class Product
{
    public $name;
    public $price;
    public $catagory;

    public function setName($arg) {
        $this->name = ucfirst($arg);
    }

    public function setCatagory($arg)
    {
        $this->catagory = strtoupper($arg);
    }

    public function FormatPrice() {
        return number_format($this->price, 2, ",", ".");
    }
}

$game1 = new Product();
// $game1->name = "Kerbal Space Program";
$game1->price = 30;
$game1->SetCatagory("Simulation");
$game1->SetName("kerbal space program");

PrintObject($game1);

function PrintObject($obj) {
    $objarr = get_object_vars($obj);
    for ($i=0; $i < count($objarr); $i++) { 
        echo (array_keys($objarr)[$i] . " : " . $objarr[array_keys($objarr)[$i]] . "<br>"); 
    }
}
?>