<?php
class Product
{
    public $name;
    public $price;
    public $currType;
    public $catagory;

    public function __construct($price, $name = "Unamed Game", $currType = "&dollar;") {
        $this->name = ucfirst($name);
        $this->price = $price;
        $this->currType = $currType;
    }

    public function setCatagory($arg)
    {
        $this->catagory = strtoupper($arg);
    }

    public function FormatPrice() {
        return number_format($this->price, 2, ",", ".");
    }
}

$game1 = new Product(30, "kerbal space program");
$game2 = new Product(20, currType: "&euro;");
// $game1->name = "Kerbal Space Program";
// $game1->price = 30;
$game1->SetCatagory("Simulation");
// $game1->SetName("kerbal space program");

PrintObject($game1);
PrintObject($game2);


function PrintObject($obj) {
    $objarr = get_object_vars($obj);
    for ($i=0; $i < count($objarr); $i++) { 
        echo (array_keys($objarr)[$i] . " : " . $objarr[array_keys($objarr)[$i]] . "<br>"); 
    }
}
?>