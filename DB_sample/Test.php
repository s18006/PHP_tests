<?php

require_once 'classes/dbManagerClass.php';
$db = new dbManager;

$query = array('type' => 'oneRowAll',
                'query' => "SELECT * FROM users WHERE id=?",
                'idxList' => 1,
                'paramList' => 'i');

print_r($db -> dbMethod('download', $query)) . PHP_EOL;

$query = array('type' => 'allData',
                'query' => "SELECT id, username, password FROM users",
                'idxList' => '',
                'paramList' => '',
                'columnLen' => 3);

print_r($db -> dbMethod('download', $query)) . PHP_EOL;




?>
