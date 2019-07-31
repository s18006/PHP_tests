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

    public function add(Entry $entry) {
        array_push($this -> directory, $entry);
        return $this;
    }

    public function iterator() {
        return new ItemIterator($this -> directory);
    }

    public function accept(Visitor $v):void {
        //$v == new ListVisitor(), $this == Directories class
        //new ListVisitor(this Directories class)
        //ListVisitor Class run inside this method
        $v -> visit($this);
    }
}

?>
