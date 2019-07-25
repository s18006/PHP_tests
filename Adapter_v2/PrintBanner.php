<?php
require_once 'Printer.php';
require_once 'Banner.php';

class PrintBanner extends Printer {
    private $banner;
    public function PrintBanner($string) {
        $this -> banner = new Banner('Hello');
    }

    public function printWeak() {
        $this -> banner -> showWithParen();
    }

    public function printStrong() {
        $this -> banner -> showWithAster();
    }
}

?>
