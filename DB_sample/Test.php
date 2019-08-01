<?php

require_once 'classes/dbManagerClass.php';
$db = new dbManager;

$query = array('type' => 'fetchWithColName',
                'query' => "SELECT * FROM users WHERE id=?",
                'idxList' => array(1),
                );

print_r($db -> dbMethod('download', $query)) . PHP_EOL;

$query = array('type' => 'fetchWithoutColName',
                'query' => "SELECT COUNT(*) FROM users",
                'idxList' => array(),
                );

print_r($db -> dbMethod('download', $query)) . PHP_EOL;




?>
