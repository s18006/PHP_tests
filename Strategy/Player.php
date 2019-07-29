<?php

class Player {
    private $name;
    private $strategy;
    private $wincount = 0;
    private $losecount = 0;
    private $gamecount = 0;

    public function __construct(string $name, $strategy) {
        $this -> name = $name;
        $this -> strategy = $strategy;
    }

    public function nextHand() {
        return $this -> strategy -> nextHand();
    }

    public function win():void {
        $this -> strategy -> study(true);
        $this -> wincount++;
        $this -> gamecount++;
    }

    public function lose():void {
        $this -> strategy -> study(false);
        $this -> losecount++;
        $this -> gamecount++;
    }

    public function even():void {
        $this -> gamecount++;
    }

    public function toString():string {
        return "[" . $this -> name . " : " . $this -> gamecount . " games, " . $this -> wincount . " win, " . $this -> losecount . " lose]";
    }
}
?>
