<?php
require_once 'DisplayImpl.php';

class StringDisplayImpl implements DisplayImpl {
    private $str;
    private $width;

    public function __construct($string) {
        $this -> str = $string;
        $this -> width = strlen($string);
    }

    public function rawOpen() {
        $this -> printLine();
    }

    public function rawPrint() {
        echo "|" . $this -> str . "|" . PHP_EOL;
    }

    public function rawClose() {
        $this -> printLine();
    }

    private function printLine() {
        $temp = "+";
        for ($i = 0; $i < $this -> width; $i++) {
            $temp .= "-";
        }
        $temp .= "+";
        echo $temp . PHP_EOL;
    }
}
?>
