<?php
require_once 'Aggregate.php';

class Bookshelf implements Aggregate {
    private $books;
    private $last = 0;

    public function BookShelf($maxsize) {
        $this -> books = new SplFixedArray($maxsize);
    }

    public function getBookAt($index) {
        if (isset($this -> books[$index])) {
            return $this -> books[$index]; 
        } else {
            return 'failed'; 
        }
    }

    public function appendBook($book) {
        $this -> books[$this -> last] = $book;
        $this -> last++;
    }

    public function getLength() {
        return $this -> last;
    }

    public function iterator() {
        return new BookShelfIterator($this);
    }
}

?>
