<?php

class Hand {

    private static $name = ['グー', 'チョキ', 'パー'];

    private $handvalue;

    //instance from strategy value
    public function Hand(int $handvalue) {
        $this -> handvalue = $handvalue;
    }

    public function isStrongerThan($h):bool {
        return self::fight($h) == 1;
    }

    public function isWeakerThan($h):bool {
        return self::fight($h) == -1;
    }

    public function getHandValue():int {
        return $this -> handvalue;
    }

    private function fight($h):int {
        if ($this == $h) {
            return 0;
        }
        else if (($this -> handvalue + 1) % 3 == $h -> getHandValue()) {
            return 1;
        } else {
            return -1;
        }
    }

    public function toString() {
        return $this -> name[$this -> handvalue];
    }
}
?>
