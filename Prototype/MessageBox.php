<?php

require_once 'Product.php';

class MessageBox implements Product {
    private $decorchar;

    public function MessageBox($decorchar) {
        $this -> decorchar = $decorchar;
    }

    public function use($s) {
        $length = strlen($s);
        $temp = "";
        $decorcharLine = "";
        for ($i = 0; $i < $length + 4; $i++) {
            $decorcharLine .= $this -> decorchar;
        }
        $decorcharLine .= "\n";
        $temp = $decorcharLine;
        $temp .= $this -> decorchar . " " . $s . " " . $this -> decorchar . "\n";
        $temp .= $decorcharLine;
        echo $temp;
    }
}

?>
