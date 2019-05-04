<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$create = new pageCreateClass();

echo $create -> pageStart(
    $head = array('title=Main', 'link_js=js/indexJs.js', 'link_css=css/index.css'),
    $form = array('method=post', 'action=newgame.php')
);

echo $create -> createNewTag(array('type=h2', 'value=IT QUIZ', 'inside=div', 'inside-class=title-container'));


$db_type = $create -> createNewSelect(array(
$select_part = array('name=db_type', 'id=db_type'),
$options_part = array('問題のタイプを選択して下さい' => array('value='), 'IT Fundamental'=> array('value=IT Fundamental'), '.com Master' => array('value=.com Master'), 'SEA/J' => array('value=SEA/J')),
));
$select_container = $create -> createNewTag(array('type=div', 'value='.$db_type, 'class=select-container'));

$newGameBtn = $create -> createNewButton(array('type=button', 'value=ニューゲーム', 'onclick=showGameBtn()', 'class=Btn'));
$newGameBtn_container = $create -> createNewTag(array('type=div', 'value='.$newGameBtn, 'class=Btn-container'));

$shortGameBtn = $create -> createNewButton(array('type=submit', 'value=ショートゲーム', 'name=newgame', 'req=value=shortGame', 'onclick=return newGameValidate()', 'class=shortGameBtn'));
$shortGameBtn_container = $create -> createNewTag(array('type=div', 'id=shortGameBtn_container', 'value='.$shortGameBtn, 'style=display:none', 'class=Btn-container'));

$longGameBtn = $create -> createNewButton(array('type=submit', 'value=ロングゲーム', 'name=newgame', 'req=value="longGame"', 'onclick=return newGameValidate()', 'class=longGameBtn'));
$longGameBtn_container = $create -> createNewTag(array('type=div', 'id=longGameBtn_container', 'value='.$longGameBtn, 'style=display:none', 'class=Btn-container'));


$newQuestionBtn = $create -> createNewButton(array('type=submit', 'value=新し問題アップロード', 'formaction=newQuestion.php', 'onclick=return newGameValidate()', 'class=newQuestionBtn'));
$newQuestionBtn_container = $create -> createNewTag(array('type=div', 'value='.$newQuestionBtn, 'class=Btn-container'));

$logoutBtn = $create -> createNewButton(array('type=submit', 'name=logout', 'value=ログアウト', 'formaction=index.php', 'class=logoutBtn'));
$logoutBtn_container = $create -> createNewTag(array('type=div', 'value='.$logoutBtn, 'class=Btn-container'));


echo $create -> createNewTag(array('type=div', 'value='.$select_container.$newGameBtn_container.$shortGameBtn_container.$longGameBtn_container.$newQuestionBtn_container.$logoutBtn_container, 'class=menu-container'));

echo $create -> formEnd();

echo $create -> pageEnd();
?>
