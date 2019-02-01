<?php
header ('Content-Type: text/html; charset="UTF-8"');
session_start();

require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$create = new pageCreateClass();

echo $create -> pageStart(
    $head_part = array('title=Result', 'link_css=css/view_style.css'),
    $form_part = ''
);

echo $create -> createNewTag(array('type=h1', 'class=game_over', 'value=ゲームオーバー '));

$result = new quizResultClass();
echo $result -> createFullGameDataTable();
echo $result -> createQADATATable();
$value = 'QUIZを見直す';
echo $create -> createNewInputButton(array('value='.$value, 'nav=newgame.php'));
echo $create -> pageEnd();
?>
