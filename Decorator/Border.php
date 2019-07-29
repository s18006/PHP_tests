<?php

require_once 'Display.php';

abstract class Border extends Display {
    protected $display;

    protected function Border(Display $display) {
        $this -> display = $display;
    }
}
?>
