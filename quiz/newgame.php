<?php
session_start();
header('Content-Type: text/html; charset="UTF-8"');
$_SESSION['counter'] = 3;
?>

<button onclick="window.location.href='index.php'"> ゲームスタート</button>
