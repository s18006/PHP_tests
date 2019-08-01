<?php

require_once 'classes/dbManagerClass.php';
$db = new dbManager;

$query = array('type' => 'fetchWithColName',
                'query' => "SELECT * FROM users",
                'parameter' => '',
                );
print_r($db -> dbMethod($query)) . PHP_EOL;

$query = array('type' => 'fetchWithoutColName',
                'query' => "SELECT COUNT(*) FROM users",
                'parameter' => '',
                );

print_r($db -> dbMethod($query)) . PHP_EOL;

$query = array('query' => "INSERT INTO users (id, username, password) VALUES (?, ?, ?)",
                'parameter' => array(5, 'Tom', '1234'),
                );

echo ($db -> dbMethod($query)) . PHP_EOL;

$query = array('query' => "DELETE FROM users WHERE id=?",
                'parameter' => 5,
                );

echo ($db -> dbMethod($query)) . PHP_EOL;




?>
