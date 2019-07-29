<?php
require_once 'Strategy.php';

class WinningStrategy implements Strategy {
    private $random;
    private $won = false;
    private $prevHand;

    public function __construct(int $playerId) {
        echo 'Player'. $playerId . ' is ready...' . PHP_EOL;
    }

    public function nextHand() {
        $this -> random = rand(0, 3);
        if(!$this -> won) {
            $this -> prevHand = new Hand($this -> random);
        }
        return $this -> prevHand;
    }

    public function study(bool $win):void {
        $this -> won = $win;
    }
}
?>
