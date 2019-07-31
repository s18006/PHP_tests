<?php

require_once 'PageMaker.php';

class Main {

    public function __construct() {
        PageMaker::makeWelcomePage('hyuki@hyuki.com', 'Welcome.html');
    }

}

$main = new Main;

?>
