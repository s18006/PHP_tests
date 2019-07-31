<?php

require_once 'Trouble.php';
require_once 'NoSupport.php';
require_once 'LimitSupport.php';
require_once 'OddSupport.php';
require_once 'SpecialSupport.php';

class Main {

    public function __construct() {
        $alice = new NoSupport('Alice');
        $bob = new LimitSupport('Bob', 100);
        $charlie = new SpecialSupport('Charlie', 429);
        $diana = new LimitSupport('Diana', 200);
        $elmo = new OddSupport('Elmo');
        $fred = new LimitSupport('Fred', 300);

        $alice -> setNext($bob) -> setNext($charlie) -> setNext($diana) -> setNext($elmo) -> setNext($fred);


        for($i = 0; $i < 500; $i+= 33) {
            $alice -> support(new Trouble($i));
        }
    }
}

$main = new Main;

?>
