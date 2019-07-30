<?php

abstract class Entry {
    public abstract function getName():string;
    public abstract function getSize():int;
    public function add(Entry $entry) {
        throw new Exception("メソッドの使い方は正しくありません!\nファイルに他のファイルを追加出来ませんよ!\n");
    }

    protected abstract function printList(string $prefix);

    public function toString():string {
        return $this -> getName() . " (" . $this -> getSize() . ")";
    }
}

?>
