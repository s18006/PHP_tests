<?php
require_once 'BookShelf.php';

$bookShelf = new BookShelf(4);
$bookShelf -> appendBook('Around the World in 80 Days');
$bookShelf -> appendBook('Bible');
$bookShelf -> appendBook('Cindarella');
$bookShelf -> appendBook('Daddy-Long-Legs');
$bookShelf -> iterator();
while($bookShelf -> hasNext()) {
    echo $bookShelf -> next(). "\n";
}
?>
