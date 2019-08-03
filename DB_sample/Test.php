<?php

require_once 'classes/dbManagerClass.php';
require_once 'classes/TableCreate.php';
$db = new dbManager;

$query = array('type' => 'fetchWithColName',
                'query' => "SELECT id, username FROM users",
                'parameter' => '',
                );
$items = $db -> dbMethod($query);
$query = array('type' => 'fetchWithColName',
                'query' => "SELECT count(id) FROM users",
                'parameter' => "",
                );

$items2 = $db -> dbMethod($query);

$table = new tableCreator('Users');
$table -> add($items);
echo $table -> create(new tableBody());

?>
