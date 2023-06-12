<?php

declare(strict_types=1);

require_once("./Music.php");
require_once("./ListenList.php");

$music1 = new Music(name:"Bach", genre:"Klassiek", listen:3);
$music2 = new Music (name: "ABC", genre: "House", listen: 2);
$music3 = new Music (name: "Mozart", genre: "Klassiek", listen: 17);

echo $music1->GetName();

$kees = new ListenList();

$kees->AddMusic($music1);
$kees->AddMusic($music2);
$kees->AddMusic($music3);

var_dump($kees);

?>