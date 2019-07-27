<?php

require_once 'Builder.php';
require_once 'Director.php';
require_once 'TextBuilder.php';
require_once 'HTMLBuilder.php';

class Main {
    public function __construct($input) {
        if ($input === 'plain') {
            $textbuilder = new TextBuilder();
            $director = new Director($textbuilder);
            $director -> construct();
            $result = $textbuilder -> getResult();
            echo $result;
        }
        if ($input === 'html') {
            $htmlbuilder = new HTMLBuilder();
            $director = new Director($htmlbuilder);
            $director -> construct();
            $result = $htmlbuilder -> getResult() . "は作成されました。";
            echo $result;
        }

        if ($input === '0' || ($input !== 'html' && $input !== 'plain')) {
            echo "Usage of plain: php7.2 Main.php plain\n";
            echo "Usage of html: php7.2 Main.php html\n";
        }
    }
}
$arg = (isset($argv[1])) ? $argv[1] : '0';
$main = new Main($arg);
?>
