<?php
require_once 'Strategy.php';

class WinningStrategy implements Strategy {
    private $random;
    private $won = false;
    private $prevHand;
    private $seed;

    public function __construct(int $seed) {
        $this -> seed = $seed;
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
