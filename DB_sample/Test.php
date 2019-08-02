<?php

require_once 'classes/dbManagerClass.php';
require_once 'classes/ItemIterator.php';
$db = new dbManager;

$query = array('type' => 'fetchWithColName',
                'query' => "SELECT * FROM users",
                'parameter' => '',
                );
$items = new ItemIterator($db -> dbMethod($query));
while ($items -> hasNext()) {
    echo '<p>' .$items -> next()['id'] . '</p>' . PHP_EOL;
}

$query = array('type' => 'fetchWithColName',
                'query' => "SELECT * FROM users",
                'parameter' => '',
                );
$items = new ItemIterator($db -> dbMethod($query));
while ($items -> hasNext()) {
    echo '<p>' .$items -> next()['username'] . '</p>' . PHP_EOL;
}

?>
