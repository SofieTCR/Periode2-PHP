<?php
// Functions
function GeneratePassword($length) {
    $GeneratedPassword = "";
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for ($i=0; $i < $length; $i++) { 
       $GeneratedPassword .= $chars[rand(0, strlen($chars) - 1)]; 
    }

    return $GeneratedPassword;
}

// Main
$wantedlength = 10;
echo "Willekeurig wachtwoord van $wantedlength tekens: " . GeneratePassword($wantedlength);
?>