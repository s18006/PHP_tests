<?php

require_once 'Support.php';

class SpecialSupport extends Support {

    private $number;
    //name variable is in Support class

    public function __construct(string $name, int $number) {
        //name instance in Support class
        parent::__construct($name);
        $this -> number = $number;
    }

    protected function resolve(Trouble $trouble):bool {
        if ($trouble -> getNumber() == $this -> number) {
            return true;
        } else {
            return false;
        }
    }
}
?>
