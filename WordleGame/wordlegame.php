<?php
$lines = file("wordlist-ascii.txt", FILE_IGNORE_NEW_LINES);

$chars = 5;
$wantedchars = array (
"", //1
"", //2
"", //3
"", //4
"", //5
"", //6
"", //7
"", //8
"", //9
"", //10
"", //11
"", //12
"", //13
"", //14
"" //15
);

$otherchars = array (
"", //1
"", //2
"", //3
"", //4
"", //5
"", //6
"", //7
"", //8
"", //9
"", //10
"", //11
"", //12
"", //13
"", //14
"" //15
);
$notwantedchars = array (
"", //1
"", //2
"", //3
"", //4
"", //5
"", //6
"", //7
"", //8
"", //9
"", //10
"", //11
"", //12
"", //13
"", //14
"" //15
);

$notchars = array (
"", //1
"", //2
"", //3
"", //4
"", //5
"", //6
"", //7
"", //8
"", //9
"", //10
"", //11
"", //12
"", //13
"", //14
"" //15
);

for ($i=0; $i < count($lines); $i++) {
    $line = strtolower($lines[$i]);
    if (strlen($line) == $chars) {
        $wordgood = true;
        $containsletters = true;
        for ($j=0; $j < $chars; $j++) { 
            if ($wantedchars[$j] != "") {
                if ($wantedchars[$j] != $line[$j]) {
                    $wordgood = false;
                }
                if ($notwantedchars[$j] == $line[$j]) {
                    $wordgood = false;
                }
            }
        }

        for ($g=0; $g < count($otherchars); $g++) { 
            if ($otherchars[$g] != "") {
                if (!str_contains($line, $otherchars[$g])) {
                    $containsletters = false;
                }
            }
        }
        for ($f=0; $f < count($notchars); $f++) { 
            if ($notchars[$f] != "") {
                if (str_contains($line, $notchars[$f])) {
                    $containsletters = false;
                }
            }
        }
        if ($wordgood && $containsletters) {
            echo "<br>" . $line;
        }
    }
}
?>