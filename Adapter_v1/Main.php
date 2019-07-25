<?php
require_once 'PrintBanner.php';

class Main {
    public function __construct() {
        $p = new PrintBanner('Hello');
        $p -> printWeak();
        $p -> printStrong();
    }
}

$main = new Main();
?>
