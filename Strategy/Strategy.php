<?php
interface Strategy {
    public function nextHand();
    public function study(bool $win):void;
}
?>
