<?php

require_once 'Border.php';

class SideBorder extends Border {

    private $borderChar;

    public function __construct(Display $display, string $ch) {
        parent::__construct($display);
        $this -> borderChar = $ch;
    }

    public function getColumns():int {
        return 1 + $this -> display -> getColumns() + 1;
    }

    public function getRows():int {
        return $this -> display -> getRows();
    }

    public function getRowText(int $row):string {
        return $this -> borderChar . $this -> display -> getRowText($row) . $this -> borderChar;
    }
}

?>
