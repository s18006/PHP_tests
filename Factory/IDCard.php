<?php
require_once 'Product.php';

class IDCard extends Product {
    private $owner;

    public function __construct($owner) {
        echo $owner .'のカードを作ります。' . PHP_EOL;
        $this -> owner = $owner;
    }

    public function use() {
        echo $this -> owner . 'のカードを使います。' . PHP_EOL;
    }

    public function getOwner() {
        return $this -> owner;
    }
}


?>
