<?php
require_once 'Aggregate.php';
require_once 'BookShelfIterator.php';

class Bookshelf extends BookShelfIterator implements Aggregate {
    private $books;
    private $last = 0;

    public function __construct($maxsize) {
        $this -> books = new SplFixedArray($maxsize);
    }

    public function appendBook($book) {
        $this -> books[$this -> last] = $book;
        $this -> last++;
    }

    public function getLength() {
        return $this -> last;
    }

    public function iterator() {
        return self::BookShelfIterator($this -> books);
    }
}

?>
