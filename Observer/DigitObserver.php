<?php

require_once 'Observer.php';

class DigitObserver implements Observer {

    public function update(NumberGenerator $generator):void {
        echo 'DigitObserver: ' . $generator -> getNumber() . PHP_EOL;

        try {
            sleep(10);
        } catch (Exception $e) {
            echo $e -> getMessage() . PHP_EOL;
        }
    }
}

?>
