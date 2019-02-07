<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();

//require_once 'controller.php';

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

$user_name = '';
if (isset($_SESSION['user_name'])) {
    $user_name = $conn ->getSession('user_name');
}
echo $create -> createNewTag(array(
    $header_text = array('type=h1', 'value=ARE YOU READY?', 'inside=header', 'class=header_text'),
    $alert = array('type=p', 'value=自分の学籍番号を記入して下さい', 'inside=div', 'inside-class=div_alert', 'class=alert'),
    $name_input = array('type=input-text', 'value='.$user_name, 'name=user_name', 'req=required', 'inside=div', 'inside-class=div_name_input', 'pattern=[a-z]{1}[0-9]{5}', 'class=name_input'),
    $hidden_input = array('type=input-hidden', 'inside=div', 'name=newgame', 'value=newgame'),
    $submit_btn = array('type=input-submit', 'inside=div', 'inside-class=div_newgameBtn', 'class=newgameBtn', 'value=ゲームスタート')
));
echo $create ->formEnd();
echo $create -> createNewButton(array('value=終了', 'class=exitBtn', 'inside=div', 'nav=exit.php'));
echo $create -> pageEnd();
?>

