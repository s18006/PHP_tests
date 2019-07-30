<?php

require_once 'Entry.php';
require_once 'ItemIterator.php';

class Directories extends Entry {

    private $name;
    private $directory = array();

    public function __construct($name) {
        $this -> name = $name;
    }

    public function getName():string {
        return $this -> name;
    }

    public function getSize():int {
        $size = 0;
        $it = new ItemIterator($this -> directory);
        while ($it -> hasNext()) {
            $size += $it -> next() -> getSize();
        }
        return $size;
    }

    public function add(Entry $entry):void {
        array_push($this -> directory, $entry);
        //return $this -> getName();
        //return $this;
    }

    public function printList(string $prefix):void {
        echo $prefix . "/" . $this -> toString() . PHP_EOL;
        $it = new ItemIterator($this -> directory);
        while ($it -> hasNext()) {
            $Pname = $prefix . "/" . $this -> name;
            echo $it -> next() -> printList($Pname);
        }
    }
}

?>
