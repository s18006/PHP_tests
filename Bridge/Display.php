<?php

class Display {
    private $impl;

    public function __construct(DisplayImpl $impl) {
        $this -> impl = $impl;
    }

    public function open() {
        $this -> impl -> rawOpen();
    }

    public function print() {
        $this -> impl -> rawPrint();
    }

    public function close() {
        $this -> impl -> rawClose();
    }

    public function display() {
        $this -> open();
        $this -> print();
        $this -> close();
    }
}


?>
