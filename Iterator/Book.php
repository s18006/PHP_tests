<?php

class Book {
    private $name;

    public function Book($name) {
        $this -> name = $name;
    }

    public function getName() {
        return $this -> name;
    }
}
?>
