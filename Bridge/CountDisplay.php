<?php
require_once 'Display.php';

class CountDisplay extends Display {
    public function __construct(DisplayImpl $impl) {
        parent::__construct($impl);
    }

    public function multiDisplay($times) {
        $this -> open();
        for ($i = 0; $i < $times; $i++) {
            $this -> print();
        }
        $this -> close();
    }
}
?>
