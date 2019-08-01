<?php

require_once 'NumberGenerator.php';

class RandomNumberGenerator extends NumberGenerator {

    private $number;

    public function getNumber():int {
        return $this -> number;
    }

    public function execute():void {
        for ($i = 0; $i < 20; $i++) {
            $this -> number = rand(0, 50);
            $this -> notifyObservers();
        }
    }

}

?>
