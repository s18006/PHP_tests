<?php

require_once 'classes/dbManagerClass.php';
require_once 'classes/TableCreate.php';
$db = new dbManager;

$query = array('type' => 'fetchWithColName',
                'query' => "SELECT id, username as user FROM users where id < ?",
                'parameter' => 3,
                );
$items = $db -> dbMethod($query);

$table = new tableBody;
$table -> addTableBody($items);
$title = new tableTitle($items[0]);
echo $table -> createTable($title);

?>
