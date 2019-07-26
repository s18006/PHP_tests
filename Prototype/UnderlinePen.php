<?php

require_once 'Product.php';

class UnderlinePen implements Product {
    private $ulchar;

    public function UnderlinePen($ulchar) {
        $this -> ulchar = $ulchar;
    }

    public function use($s) {
        $length = strlen($s);
        $temp = "\" " . $s . " \" \n";
        for ($i = 0; $i < $length + 4; $i++) {
            $temp .= $this -> ulchar;
        }
        $temp .= "\n";
        echo $temp;
    }
}

?>
