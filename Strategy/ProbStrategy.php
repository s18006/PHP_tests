<?php

require_once 'Strategy.php';

class ProbStrategy implements Strategy {
    private $random;
    private $prevHandValue = 0;
    private $currentHandValue = 0;
    private $history = [[1, 1, 1,], [1, 1, 1], [1, 1, 1]];

    public function __construct(int $playerId) {
        echo 'Player' . $playerId . ' is ready...' . PHP_EOL;
    }

    public function nextHand() {
        $bet = rand(0, $this -> getSum($this -> currentHandValue));
        $handvalue = 0;
        if ($bet < $this -> history[$this -> currentHandValue][0]) {
            $handvalue = 0;
        }
        else if ($bet < $this -> history[$this -> currentHandValue][0] + $this -> history[$this -> currentHandValue][1]) {
            $handvalue = 1;
        } else {
            $handvalue = 2;
        }
        $this -> prevHandValue = $this -> currentHandValue;
        $this -> currentHandValue = $handvalue;
        return new Hand($handvalue);
    }

    private function getSum(int $hv):int {
        $sum = 0;
        for ($i = 0; $i < 3; $i++) {
            $sum += $this -> history[$hv][$i];
        }
        return $sum;
    }

    public function study(bool $win):void {
        if ($win) {
            $this -> history[$this -> prevHandValue][$this -> currentHandValue]++;
        } else {
            $this -> history[$this -> prevHandValue][($this -> currentHandValue + 1) % 3]++;
            $this -> history[$this -> prevHandValue][($this -> currentHandValue + 2) % 3]++;
        }
    }
}



?>
