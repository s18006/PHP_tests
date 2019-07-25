<?php
class Banner {
    private $str;

    public function Banner($string) {
        $this -> str = $string;
    }

    public function showWithParen() {
        echo "(" . $this -> str . ")\n";
    }

    public function showWithAster() {
        echo "*" . $this -> str . "*\n";
    }
}

?>
