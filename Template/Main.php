<?php
require_once 'CharDisplay.php';
require_once 'StringDisplay.php';

class Main {
    public function __construct() {
        $d1 = new CharDisplay('H');
        $d2 = new StringDisplay('Hello, world.');
        $d3 = new StringDisplay('こんにちは');
        $d1 -> display();
        $d2 -> display();
        $d3 -> display();
    }
}

$main = new Main();

?>
