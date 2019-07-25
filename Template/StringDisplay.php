<?php

require_once 'AbstractDisplay.php';

class StringDisplay extends AbstractDisplay {
    private $str;
    private $width;

    public function StringDisplay($string) {
        $this -> str = $string;
        $this -> width = strlen($string);
    }

    public function open() {
        self::printLine();
    }

    public function printer() {
        echo "|" . $this -> str . "|\n";
    }

    public function close() {
        self::printLine();
    }

    public function printLine() {
        $temp = "+";
        for ($i = 0; $i < $this -> width; $i++) {
            $temp .= "-";
        }
        $temp .= "+\n";
        echo $temp;
    }
}

?>
