<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$create = new pageCreateClass();
require_once 'server.php';

echo $create -> pageStart(
    $head_part = array('title=Login', 'link_css=css/login.css'),
    $form_part = array('action=self', 'method=post')
);

echo $create -> createNewTag(array(
    $header = array('type=h2', 'value=ログイン', 'inside=div', 'inside-class=header')
));

//define content of login-container
//login row
$userNameField = $create -> createNewTag(array(
    array('type=img', 'src=images/login/user-circle-solid.svg'),
    array('type=input-text', 'name=username', 'value='.$username, 'placeholder=ユーザー名')
));
$loginContainer = $create -> createNewTag(array('type=div', 'class=input-group', 'value='.$userNameField));
//password row
$passwordField = $create -> createNewTag(array(
    array('type=img', 'src=images/login/key-solid.svg'),
    array('type=input-password', 'name=password', 'value=', 'placeholder=パスワード')
));
$passwordContainer = $create -> createNewTag(array('type=div', 'class=input-group', 'value='.$passwordField));

$submitBtnContainer = $create -> createNewButton(array('type=input-submit', 'value=ログイン', 'name=login', 'class=btn', 'inside=div', 'inside-class=input-group_submit'));

echo $create -> createNewTag(array('type=div', 'class=login-container', 'value='.$errors.$loginContainer.$passwordContainer.$submitBtnContainer));

echo $create -> formEnd();
echo $create -> pageEnd();
?>
