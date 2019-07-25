<?php
require_once 'Printer.php';
require_once 'Banner.php';

class PrintBanner extends Banner implements Printer {
    public function PrintBanner($string) {
        parent::__construct($string);
    }

    public function printWeak() {
        parent::showWithParen();
    }

    public function printStrong() {
        parent::showWithAster();
    }
}
?>
