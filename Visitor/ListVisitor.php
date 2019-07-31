<?php

require_once 'Visitor.php';

class ListVisitor extends Visitor {
    private $currentdir = '';

    public function visit($element):void {
        if (get_class($element) === 'File') {
            $this -> visitFile($element);
        }
        if (get_class($element) === 'Directories') {
            $this -> visitDirectories($element);
        }
    }

    public function visitFile($element) {
        echo $this -> currentdir . "/" . $element . PHP_EOL;
    }

    public function visitDirectories($element) {
        echo $this -> currentdir . "/" . $element . PHP_EOL;
        $savedir = $this -> currentdir;
        $this -> currentdir .= "/" . $element -> getName();
        $it = $element -> iterator();
        while ($it -> hasNext()) {
            $it -> next() -> accept($this);
        }
        $this -> currentdir = $savedir;
    }
}


?>
