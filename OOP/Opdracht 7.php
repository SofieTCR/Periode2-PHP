<?php
class Product
{
    public function __construct(public $price, public $name = "Unamed Game", public $currType = "&dollar;") {
        $this->name = ucfirst($name);
    }

    public function FormatPrice() {
        return number_format($this->price, 2, ",", ".");
    }

}

$muziek1 = new Product(19.99, "All I want for christmas is you");
var_dump($muziek1);

