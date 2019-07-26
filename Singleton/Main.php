<?php

require_once 'Singleton.php';

class Main {
    public function __construct() {
        //obj1の場合はインスタンスが行われる
        $obj1 = Singleton::getInstance();
        //obj2の場合はインスタンスが行われない
        $obj2 = Singleton::getInstance();
        if ($obj1 === $obj2) {
            echo 'obj1とobj2は同じインスタンスです。'. PHP_EOL;
        } else {
            echo 'obj1とobj2は同じインスタンスではありません。'. PHP_EOL;
        }
    }
}

$main = new Main();
?>
