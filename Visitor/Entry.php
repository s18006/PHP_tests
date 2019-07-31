<?php

require_once 'Element.php';

abstract class Entry implements Element {
    public abstract function getName():string;
    public abstract function getSize():int;
    public function add(Entry $entry) {
        throw new Exception("メソッドの使い方は正しくありません!\nファイルに他のファイルを追加出来ませんよ!\n");
    }

    public function Iterator() {
        throw new Exception("メソッドの使い方は正しくありません!\nファイルに他のファイルを追加出来ませんよ!\n");
    }

    public function __tostring():string {
        return $this -> getName() . " (" . $this -> getSize() . ")";
    }
}

?>
