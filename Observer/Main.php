<?php

require_once 'DigitObserver.php';
require_once 'GraphicObserver.php';
require_once 'RandomNumberGenerator.php';

class Main {

    public function __construct() {
        $generator = new RandomNumberGenerator();
        $observer1 = new DigitObserver();
        $observer2 = new GraphicObserver();

        $generator -> addObserver($observer1);
        $generator -> addObserver($observer2);

        $generator -> execute();
    }
}

new Main;
?>
