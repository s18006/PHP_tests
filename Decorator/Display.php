<?php

abstract class Display {
    public abstract function getColumns():int;
    public abstract function getRows():int;
    public abstract function getRowText(int $row):string;
    public function show():void {
        for ($i = 0; $i < $this -> getRows(); $i++) {
            echo $this -> getRowText($i) . PHP_EOL;
        }
    }

}
?>
