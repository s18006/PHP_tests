<?php

require_once 'Builder.php';
require_once 'Director.php';
require_once 'TextBuilder.php';

class Main {
    public function __construct($input) {
        if ($input === 'plain') {
            $textbuilder = new TextBuilder();
            $director = new Director($textbuilder);
            $director -> construct();
            $result = $textbuilder -> getResult();
            echo $result;
        }
    }
}

$main = new Main($argv[1]);
?>
