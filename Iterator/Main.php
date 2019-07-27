<?php
require_once 'BookShelf.php';
require_once 'BookShelfIterator.php';

class Main {
    public function __construct() {
        $bookShelf = new BookShelf(4);
        $bookShelf -> appendBook('Around the World in 80 Days');
        $bookShelf -> appendBook('Bible');
        $bookShelf -> appendBook('Cindarella');
        $bookShelf -> appendBook('Daddy-Long-Legs');
        $it = $bookShelf -> iterator();
        while($it -> hasNext()) {
            echo $it -> next(). "\n";
        }
    }
}
$main = new Main();
?>
