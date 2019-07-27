<?php
require_once 'Book.php';
require_once 'BookShelf.php';
require_once 'BookShelfIterator.php';

class Main {
    public function __construct() {
        $bookShelf = new BookShelf(4);
        $bookShelf -> appendBook(new Book('Around the World in 80 Days'));
        $bookShelf -> appendBook(new Book('Bible'));
        $bookShelf -> appendBook(new Book('Cindarella'));
        $bookShelf -> appendBook(new Book('Daddy-Long-Legs'));
        $it = $bookShelf -> iterator();
        while($it -> hasNext()) {
            echo $it -> next() -> getName(). "\n";
        }
    }
}
$main = new Main();
?>
