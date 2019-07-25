<?php
require_once 'AbstractDisplay.php';

class CharDisplay extends AbstractDisplay {
    protected $ch;

    public function CharDisplay($ch) {
        $this -> ch = $ch;
    }

    public function open() {
        echo "<<";
    }

    public function printer() {
        echo $this -> ch;
    }

    public function close() {
        echo ">>". PHP_EOL;
    }

}

?>
