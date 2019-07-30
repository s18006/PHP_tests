<?php

require_once 'Entry.php';

class File extends Entry {
    private $name;
    private $size;

    public function __construct(string $name, int $size) {
        $this -> name = $name;
        $this -> size = $size;
    }

    public function getName():string {
        return $this -> name;
    }

    public function getSize():int {
        return $this -> size;
    }

    protected function printList(string $prefix):void {
        echo $prefix . "/"  . $this -> toString() . PHP_EOL;
    }
}

?>
