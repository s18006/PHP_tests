<?php
require_once 'IDCardFactory.php';

class Main {
    public function __construct() {
        $factory = new IDCardFactory();
        $card1 = $factory -> create('田中');
        $card2 = $factory -> create('千春');
        $card3 = $factory -> create('Tom');
        $card1 -> use();
        $card2 -> use();
        $card3 -> use();
    }
}

$main = new Main();

?>
