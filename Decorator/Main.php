<?php
require_once 'StringDisplay.php';
require_once 'SideBorder.php';
require_once 'FullBorder.php';


class Main {

    public function __construct() {
        $b1 = new StringDisplay("Hello, world.");
        $b2 = new SideBorder($b1, '#');
        $b3 = new FullBorder($b2);
        $b4 = new SideBorder(
                    new FullBorder(
                        new FullBorder(
                            new SideBorder(
                                new FullBorder(
                                    new StringDisplay("Hello, Universe.")
                                ),
                                '*'
                            )
                        )
                    ),
                    '/'
                );
        $b1 -> show();
        $b2 -> show();
        $b3 -> show();
        $b4 -> show();
    }
}

$main = new Main();
?>
