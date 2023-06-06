<?php

require_once("./Music.php");

$music1 = new Music(name:"Bach", genre:"Klassiek", listen:3);

echo $music1->GetName();

var_dump($music1);

?>