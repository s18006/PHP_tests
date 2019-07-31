<?php

require_once 'Support.php';

class OddSupport extends Support {

    //name variable is in Support class
    public function __construct(string $name) {
        //name instance in Support class
        parent::__construct($name);
    }

    protected function resolve(Trouble $trouble):bool {
        if ($trouble -> getNumber() % 2 == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>
