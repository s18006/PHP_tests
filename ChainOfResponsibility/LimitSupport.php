<?php

require_once 'Support.php';

class LimitSupport extends Support {

    private $limit;
    //name variable is in Support class

    public function __construct(string $name, int $limit) {
        //name instance in Support class
        parent::__construct($name);
        $this -> limit = $limit;
    }

    protected function resolve(Trouble $trouble):bool {
        if ($trouble -> getNumber() < $this -> limit) {
            return true;
        } else {
            return false;
        }
    }
}
?>
