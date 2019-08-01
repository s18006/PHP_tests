<?php

require_once 'ItemIterator.php';

abstract class NumberGenerator {

    //value is DigitObserver instance
    private $observers = array();

    public function addObserver(Observer $observer):void {
        array_push($this -> observers, $observer);
    }

    public function deleteObserver(Observer $observer):void {
        if (($key = array_search($observer, $this -> observers)) !== false) {
            unset($this -> observers[$key]);
            array_values($this -> observers);
}
    }

    public function notifyObservers() {
        $it = new ItemIterator($this -> observers);
        while ($it -> hasNext()) {
            $o = $it -> next();
            //send data (class instance) to DigitObserver and GraphicObserver
            $o -> update($this);
        }
    }

    public abstract function getNumber():int;
    public abstract function execute():void;
}

?>
