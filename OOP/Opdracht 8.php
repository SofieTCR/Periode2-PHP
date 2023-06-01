<?php
class Product
{
    public function __construct(public $price, public $name = "Unamed Song", public $currType = "&dollar;") {
        $this->name = ucfirst($name);
    }

    public function FormatPrice() {
        return number_format($this->price, 2, ",", ".");
    }

    public function getProduct() {
        return "Het product: {$this->name} kost {$this->currType}{$this->FormatPrice()}";
    }
}

$product1 = new Product(name: "Techno beats", currType: "&euro;", price: 6);
$product2 = new Product(name: "Ph1lza beats", currType: "&euro;", price: 2);
$product3 = new Product(name: "Tubbo beats", currType: "&dollar;", price: 1.2);

echo ($product1->getProduct() . "<br>");
echo ($product2->getProduct() . "<br>");
echo ($product3->getProduct() . "<br>");
