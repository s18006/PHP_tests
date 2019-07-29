<?php
require_once 'Display.php';

class StringDisplay extends Display {

    private $str;

    public function __construct($string) {
        $this -> str = $string;
    }

    public function getColumns():int {
        return strlen($this -> str);
    }

    public function getRows():int {
        return 1;
    }

    public function getRowText(int $row):string {
        if ($row === 0) {
            return $this -> str;
        } else {
            return null;
        }
    }
}

?>
