<?php
header ('Content-Type: text/html; charset="UTF-8"');
session_start();

require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$create = new pageCreateClass();

echo $create -> pageStart(
    $head_part = array('title=Result', 'link_css=css/view_style.css'),
    $form_part = array('action=newgame.php', 'method=post')
);

echo $create -> createNewTag(array('type=h1', 'class=game_over', 'value=ゲームオーバー '));

$result = new quizResultClass();
echo $result -> createFullGameDataTable();
echo $result -> createQADATATable();
echo $create -> createNewTag(array('type=input-hidden', 'value='.$result -> newQuestionListSet(), 'name=repeatSeq'));
echo $create -> createNewTag(array('type=input-submit', 'value=ニューゲーム', 'class=endgame', 'nav=newgame.php'));
echo $create -> formEnd();
echo $create -> createNewButton(array('value=終了', 'class=exitBtn', 'inside=div', 'nav=exit.php'));
echo $create -> pageEnd();
?>
