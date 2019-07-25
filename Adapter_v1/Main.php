<?php
require_once 'PrintBanner.php';

class Main extends PrintBanner {
    public function __construct() {
        $p = parent::PrintBanner('Hello');
        $p -> printWeak();
        $p -> printStrong();
    }
}

?>
