<?php
// Set the minimum and maximum values for the code
$min = 1000;
$max = 9999;

// Generate a random number within the given range
$postcode = rand($min, $max);

// Convert the number to a string and add the letter code to the end
$postcode = strval($postcode) . " " . chr(rand(65, 90)) . chr(rand(65, 90));

// Output the final code
echo "Een willekeurige postcode is: $postcode";
?>