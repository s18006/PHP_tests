<?php

require_once 'Support.php';

class NoSupport extends Support {

    //name variable in Support class
    public function __construct($name) {
        //instance in Support class
        parent::__construct($name);
    }

    protected function resolve(Trouble $trouble):bool {
        return false;
    }
}
?>
