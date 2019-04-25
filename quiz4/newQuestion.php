<?php

require_once 'classes/controllerClass.php';
$conn = new controllerClass();

$create = new pageCreateClass();

//page head
echo $create -> pageStart(
    $head_part = array('title=New Question', 'link_js=js/validate.js', 'link_css=css/newQuestion.css'),
    $form_part = array('method=post', 'action=self')
);

//h1 part
//echo $create -> createNewTag(array('type=h1', 'value=新たな問題のアップロード'));

//h2 part
echo $create -> createNewTag(array(
    $alert_tag = array('type=h2', 'value=まず同じような問題があるかどうかを確認するために、アップロードしたい問題のキーワードを入力して下さい'),
    $input_tag = array('type=input-text', 'class=keyWord', 'id=keyWord', 'placeholder=キーワード', 'value=', 'onInput=validate()', 'inside=div', 'inside-class=container-keyWord')
));

$hiddenBtn = $create -> createNewButton(array('id=hiddenElementBtn', 'type=button', 'onclick=hiddenElement()', 'value=隠す', 'inside=div', 'inside-class=container-keyWord'));
echo $create -> createNewTag(array('type=div', 'value='.$hiddenBtn, 'class=container-hiddenBtn'));
echo $create -> createNewTag(array('type=div', 'value=', 'id=result_text'));
echo $create -> formEnd();

//create table content (input field)
$user_id = $create -> createNewTag(array('type=input-text', 'value=', 'placeholder=学籍番号', 'pattern=[a-z]{1}[0-9]{5}'));
$question = $create -> createNewTag(array('type=input-text', 'value=', 'placeholder=質問'));
$question_type = $create -> createNewSelect(array(
$select_part = array('name=question_type', 'onChange=tableChange(this)', 'value='),
$options_part = array('-' => array('value='), '選択問題' => array('value=select'), '選択問題(選択可能：2問以上)' => array('value=checkbox'), 'ベット(数字)' => array('value=bet-number'), 'ベット(文字)' => array('value=bet-text')),
));
$right_answer = $create -> createNewTag(array('type=input-text', 'name=right_answer', 'value=', 'placeholder=正解な答え'));
$right_answer2 = $create -> createNewTag(array('type=input-text', 'name=right_answer2', 'value=', 'placeholder=正解な答え'));
$right_answer3 = $create -> createNewTag(array('type=input-text', 'name=right_answer3', 'value=', 'placeholder=正解な答え'));
$option1 = $create -> createNewTag(array('type=input-text', 'name=option1', 'value=', 'placeholder=オプション1'));
$option2 = $create -> createNewTag(array('type=input-text', 'name=option2', 'value=', 'placeholder=オプション2'));
$option3 = $create -> createNewTag(array('type=input-text', 'name=option3', 'value=', 'placeholder=オプション3'));
$option4 = $create -> createNewTag(array('type=input-text', 'name=option4', 'value=', 'placeholder=オプション4'));
$option5 = $create -> createNewTag(array('type=input-text', 'name=option5', 'value=', 'placeholder=オプション5'));
$options_length = $create -> createNewTag(array('type=input-number', 'name=options-length', 'value='));

//table create
$table_row1 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'value=学籍番号'),
    $td_2 = array('type=td', 'value='.$user_id)
));

$table_mainrow1 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'colspan=2', 'style=font-weight:bold; text-align:center', 'value=問題情報'),
));

$table_row2 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'value=質問'),
    $td_2 = array('type=td', 'value='.$question)
));

$table_row3 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'value=問題種類'),
    $td_2 = array('type=td', 'value='.$question_type)
));

$table_mainrow2 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'colspan=2', 'style=font-weight:bold; text-align:center', 'value=正解な回答に関する情報'),
));

$table_row4 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'value=正解な回答'),
    $td_2 = array('type=td', 'value='.$right_answer)
));
//if checkbox...
$table_row4_2 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=rightAnswer2', 'style=display:none', 'value=正解な回答2'),
    $td_2 = array('type=td', 'class=rightAnswer2', 'style=display:none', 'value='.$right_answer2)
));
$table_row4_3 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=rightAnswer2', 'style=display:none', 'value=正解な回答3'),
    $td_2 = array('type=td', 'class=rightAnswer2', 'style=display:none', 'value='.$right_answer3)
));

$table_mainrow2 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'colspan=2', 'style=font-weight:bold; text-align:center; display:none', 'class=option1stPart', 'value=不正解なオプションに関する情報'),
));

$table_row5 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option1stPart', 'style=display:none', 'value=不正解なオプション1'),
    $td_2 = array('type=td', 'class=option1stPart', 'style=display:none', 'value='.$option1)
));
$table_row6 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option1stPart', 'style=display:none', 'value=不正解なオプション2'),
    $td_2 = array('type=td', 'class=option1stPart', 'style=display:none', 'value='.$option2)
));
$table_row7 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option1stPart', 'style=display:none', 'value=不正解なオプション3'),
    $td_2 = array('type=td', 'class=option1stPart', 'style=display:none', 'value='.$option3)
));
$table_row8 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option2ndPart', 'style=display:none', 'value=不正解なオプション4'),
    $td_2 = array('type=td', 'class=option2ndPart', 'style=display:none', 'value='.$option4)
));
$table_row9 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option2ndPart', 'style=display:none', 'value=不正解なオプション5'),
    $td_2 = array('type=td', 'class=option2ndPart', 'style=display:none', 'value='.$option5)
));











echo $create -> createNewTable(array('type=table'));

?>
