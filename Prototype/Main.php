<?php

require_once 'Product.php';
require_once 'Manager.php';
require_once 'MessageBox.php';
require_once 'UnderlinePen.php';

class Main {

   public function __construct() {
        $manager = new Manager();
        $mbox = new MessageBox('*');
        $sbox = new MessageBox('/');
        $upen = new UnderlinePen('~');
        $manager -> register("warning box", $mbox);
        $manager -> register("slash box", $sbox);
        $manager -> register("strong message", $upen);
        $p1 = $manager -> create("warning box");
        $p2 = $manager -> create("slash box");
        $p3 = $manager -> create("strong message");
        $p3 -> use("I can");
        $p1 -> use("create");
        $p2 -> use("a new");
        $p2 -> use("prototype");
   }
}

$main = new Main();
?>
