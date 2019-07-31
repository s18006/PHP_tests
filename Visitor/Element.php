<?php

interface Element {
    public function accept(Visitor $v):void;
}

?>
