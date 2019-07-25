<?php
abstract class Factory {
    public function create($owner) {
        $p = $this -> createProduct($owner);
        $this -> registerProduct($owner);
        return $p;
    }

    public abstract function createProduct($owner);
    public abstract function registerProduct($product);

}
?>
