<?php
session_start();
header('Content-Type: text/html; charset="UTF-8"');
require_once 'controller.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link style="text/css" rel="stylesheet" href="css/view_style.css">
    </head>
    <body>
<form action="view.php" method="POST">
<input type="hidden" name="newgame" value="newgame"/>
<input type="submit" class="newgameBtn" value="ゲームスタート"/>
</form>
    </body>
</html>
