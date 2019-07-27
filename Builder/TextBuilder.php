<?php
require_once 'Builder.php';

class TextBuilder extends Builder {
    private $buffer = "";

    public function makeTitle($title) {
        $this -> buffer .= "==============================\n";
        $this -> buffer .= " 「" .$title ."」\n";
        $this -> buffer .= "\n";
    }

    public function makeString($str) {
        $this -> buffer .= "■Á" .$str."\n";
        $this -> buffer .= "\n";
    }

    public function makeItems($items) {
        for ($i = 0; $i < count($items); $i++) {
            $this -> buffer .= " ・" . $items[$i] ."\n";
        }
        $this -> buffer .= "\n";
    }

    public function close() {
        $this -> buffer .= "==============================\n";
    }

    public function getResult() {
        return $this -> buffer;
    }
}
?>
