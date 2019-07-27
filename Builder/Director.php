<?php

require_once 'Builder.php';

class Director {
    private $builder;

    public function Director($builder) {
        $this -> builder = $builder;
    }

    public function construct() {
        $this -> builder -> makeTitle("Greeting");
        $this -> builder -> makeString("朝から昼にかけて");
        $this -> builder -> makeItems(array("おはようございます。", "こんにちは。"));
        $this -> builder -> makeString("夜に");
        $this -> builder -> makeItems(array("こんばんは。", "おやすみなさい", "さようなら。"));
        $this -> builder -> close();
    }
}
?>
