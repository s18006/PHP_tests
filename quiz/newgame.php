

<?php
session_start();
header('Content-Type: text/html; charset="UTF-8"');
include_once ('randSeqClass.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <link style="text/css" rel="stylesheet" href="css/viewstyle.css">
    </head>
    <body>
<?php

$randSeq = new randSeqClass ();
$randSeq -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
$randSeq -> connection();
$randSeq -> setLengthOfQuiz(5);
//define random sequence as session array
$_SESSION['randSeq'] = $randSeq->randomSequence();
//define index as session in order to change the question and answer options
$_SESSION['idx'] = 0;
//define 3life points
$_SESSION['counter'] = 3;

?>
<button onclick="window.location.href='view.php'"> ゲームスタート</button>

    </body>
</html>

