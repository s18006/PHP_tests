<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();
//if user doesn't choose play type and length, send back user to index.php
if (!isset($_POST['newgame']) && !isset($_SESSION['gameType'])) {
//    header('Location: index.php');
}
//if it exists, get last game values
if (isset($_POST['repeatSeq'])) {
    $repeatSeq = $_POST['repeatSeq'];
} else {
    $repeatSeq = '';
}
$create = new pageCreateClass();
$newgame = new newgameClass($repeatSeq);

echo $create -> pageStart(
    $head_part = array('title=New Game', 'link_css=css/view_style.css'),
    $form_part = array('method=post', 'action=view.php')
);

$user_name = $_SESSION['username'];
$newgame_field = $create -> createNewTag(array(
    $header_text = array('type=h1', 'value=ARE YOU READY?', 'class=header_text'),
    $name_input = array('type=input-text', 'value='.$user_name, 'name=user_name', 'req=disabled', 'class=name_input'),
    $hidden_input = array('type=input-hidden', 'name=newgame', 'value=newgame'),
    $submit_btn = array('type=input-submit', 'class=newgameBtn', 'value=ゲームスタート')
));
echo $create -> createNewTag(array('type=div', 'value='.$newgame_field, 'class=div_newgame'));
echo $create ->formEnd();
echo $create -> createNewButton(array('value=終了', 'class=exitBtn', 'inside=div', 'nav=exit.php'));
echo $create -> pageEnd();
?>

