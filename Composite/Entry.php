<?php

abstract class Entry {
    public abstract function getName():string;
    public abstract function getSize():int;
    public function add(Entry $entry) {
        throw Exception("メソッドの使い方は正しくありません!");
    }

    protected abstract function printList(string $prefix);

    public function toString():string {
        return $this -> getName() . " (" . $this -> getSize() . ")";
    }
}

?>
