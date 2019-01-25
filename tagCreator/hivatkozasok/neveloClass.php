<?php

header('Content-Type: text/html; charset=utf-8');
class neveloClass {
    public function nevelo($input) {
        $betu1 = $input[0];
        $nevelo = 'Az ';
        if ($betu1 === 'B' || $betu1 === 'C' || $betu1 === 'D' || $betu1 === 'F' || $betu1 === 'G' || $betu1 === 'H' || $betu1 === 'J' || $betu1 === 'K' || $betu1 === 'L' || $betu1 === 'M' || $betu1 === 'N' || $betu1 === 'P' || $betu1 === 'Q' || $betu1 === 'R' || $betu1 === 'S' || $betu1 === 'T' || $betu1 === 'V' || $betu1 === 'W' || $betu1 === 'X' || $betu1 === 'Y' || $betu1 === 'Z' || $betu1 === 'b' || $betu1 === 'c' || $betu1 === 'd' || $betu1 === 'f' || $betu1 === 'g' || $betu1 === 'h' || $betu1 === 'j' || $betu1 === 'k' || $betu1 === 'l' || $betu1 === 'm' || $betu1 === 'n' || $betu1 === 'p' || $betu1 === 'q' || $betu1 === 'r' || $betu1 === 's' || $betu1 === 't' || $betu1 === 'v' || $betu1 === 'w' || $betu1 === 'x' || $betu1 === 'y' || $betu1 === 'z') { $nevelo = 'A ';}
            return $nevelo;
    }

    public function kisnevelo($input) {
        $betu1 = $input[0];
        $kisnevelo = 'az ';
        if ($betu1 === 'B' || $betu1 === 'C' || $betu1 === 'D' || $betu1 === 'F' || $betu1 === 'G' || $betu1 === 'H' || $betu1 === 'J' || $betu1 === 'K' || $betu1 === 'L' || $betu1 === 'M' || $betu1 === 'N' || $betu1 === 'P' || $betu1 === 'Q' || $betu1 === 'R' || $betu1 === 'S' || $betu1 === 'T' || $betu1 === 'V' || $betu1 === 'W' || $betu1 === 'X' || $betu1 === 'Y' || $betu1 === 'Z' || $betu1 === 'b' || $betu1 === 'c' || $betu1 === 'd' || $betu1 === 'f' || $betu1 === 'g' || $betu1 === 'h' || $betu1 === 'j' || $betu1 === 'k' || $betu1 === 'l' || $betu1 === 'm' || $betu1 === 'n' || $betu1 === 'p' || $betu1 === 'q' || $betu1 === 'r' || $betu1 === 's' || $betu1 === 't' || $betu1 === 'v' || $betu1 === 'w' || $betu1 === 'x' || $betu1 === 'y' || $betu1 === 'z') { $kisnevelo = 'a ';}
        return $kisnevelo;
    }
}


?>
