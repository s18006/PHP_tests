<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();

$exit = new exitGameClass();
echo $exit -> pageStart(
    $head_part = array('title=Exit', 'link_css=css/view_style.css'),
    $form_part = ''
);
echo $exit -> createNewTag(array('type=h1', 'value=ゲームををご利用いただきありがとうございます。', 'class=byeText'));
echo $exit -> pageEnd();


?>
