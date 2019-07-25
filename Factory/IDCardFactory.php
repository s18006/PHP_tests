<?php

require_once 'Factory.php';
require_once 'IDCard.php';

class IDCardFactory extends Factory {
    private $owner = array();
    private $IDCard;

    public function createProduct($owner) {
        return $this -> IDCard = new IDCard($owner);
    }

    public function registerProduct($product) {
        $owner[] = $this -> IDCard -> getOwner();
    }

    public function getOwners() {
        return $this -> owners;
    }

}


?>
