<?php

class TicketMaker {
    private $ticket = 1000;
    private static $singleton;

    private function __construct() {
        $this->ticket++;
        echo $this->ticket . PHP_EOL;
    }

    public static function getNextTicketNumber() {
        if (is_null(self::$singleton)) {
            self::$singleton = new self();
        } else {
            echo 'TicketMaker Classのインスタンスをもう一回出来ません。' . PHP_EOL;
        }
        return self::$singleton;
    }
}

class Main {
    public function __construct() {
        $obj1 = TicketMaker::getNextTicketNumber();
        $obj2 = TicketMaker::getNextTicketNumber();
    }
}

$main = new Main();
?>
