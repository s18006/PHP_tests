
<?php
session_start();
header('Content-Type: text/html; charset="UTF-8"');
require_once 'classes/randSeqClass.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link style="text/css" rel="stylesheet" href="css/view_style.css">
    </head>
    <body>
<?php

$randSeq = new randSeqClass ();
$randSeq -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
$randSeq -> connection();
$randSeq -> clearTable(); //clear the last game result
$randSeq -> setLengthOfQuiz(5);
//define random sequence as session array
$_SESSION['randSeq'] = $randSeq->randomSequence();
//define index as session in order to change the question and answer options
$_SESSION['idx'] = 0;
//define 3life points
$_SESSION['counter'] = 3;

?>

<form action="view.php" method="POST">
<input type="hidden" name="newgame" value="newgame"/>
<input type="submit" class="newgameBtn" value="ゲームスタート"/>
</form>
    </body>
</html>

