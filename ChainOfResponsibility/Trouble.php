<?php

class Trouble {

    private $number;

    public function __construct(int $number) {
        $this -> number = $number;
    }

    public function getNumber():int {
        return $this -> number;
    }

    public function __tostring() {
        return "[Trouble " . $this -> number . "]\n";
    }




}


?>
