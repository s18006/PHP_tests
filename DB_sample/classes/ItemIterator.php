<?php

class ItemIterator {
    private $shelf;
    private $index;
    public function __construct($shelf) {
        $this -> shelf = $shelf;
        $this -> index = 0;
    }
    public function hasNext():bool {
        if ($this -> index < count($this -> shelf)) {
            return true;
        } else {
            return false;
        }
    }
    public function next() {
        $item = $this -> shelf[$this -> index];
        $this -> index++;
        return $item;
    }
}

?>
