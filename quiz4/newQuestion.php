<?php

require_once 'classes/controllerClass.php';
$conn = new controllerClass();

$create = new pageCreateClass();

//page head
echo $create -> pageStartWithTag(
    $head_part = array('title=New Question', 'link_js=js/validate.js', 'link_css=css/newQuestion.css'),
    $form_part = array('method=post', 'action=self', 'onsubmit=return uploadCheck()'),
    $header_part = array('value=QUIZ問題のアップロード', 'type=h1', 'inside=header'));

//search container
$search_field = $create -> createNewTag(array(
    $alert_tag = array('type=h3', 'value=まず同じような問題があるかどうかを確認するために、アップロードしたい問題のキーワードを入力して下さい'),
    $input_tag = array('type=input-search', 'class=keyWord', 'id=keyWord', 'placeholder=キーワード', 'value=', 'onInput=validate()', 'inside=div', 'inside-class=container-keyWord')
));

$result_text = $create -> createNewTag(array('type=div', 'value=', 'id=result_text'));

echo $create -> createNewTag(array('type=div', 'class=searchField-container', 'value='.$search_field.$result_text));


//create table content (input field)
$user_id = $create -> createNewTag(array('type=input-text', 'id=userId', 'name=userId', 'value=', 'placeholder=学籍番号', 'pattern=[a-z]{1}[0-9]{5}'));

$question = $create -> createNewTag(array('type=input-text', 'id=question', 'name=question', 'value=', 'placeholder=質問'));

$question_type = $create -> createNewSelect(array(
$select_part = array('name=question_type', 'id=question_type', 'onChange=tableChange(this)', 'value='),
$options_part = array('-' => array('value='), '選択問題' => array('value=select'), '選択問題(選択可能：2問以上)' => array('value=checkbox'), 'ベット(数字)' => array('value=bet-number'), 'ベット(文字)' => array('value=bet-text')),
));

$answer_length = $create -> createNewTag(array('type=input-number', 'name=answer_length', 'id=answerLength', 'value=', 'min=2', 'max=3', 'onInput=checkboxAnswers(this)'));

$right_answer = $create -> createNewTag(array('type=input-text', 'id=right_answer', 'name=right_answer', 'value=', 'placeholder=正解な答え'));

$right_answer2 = $create -> createNewTag(array('type=input-text', 'id=right_answer2', 'name=right_answer2', 'value=', 'placeholder=正解な答え'));

$right_answer3 = $create -> createNewTag(array('type=input-text', 'id=right_answer3', 'name=right_answer3', 'value=', 'placeholder=正解な答え'));

$option1 = $create -> createNewTag(array('type=input-text', 'name=option1', 'value=', 'id=option1', 'placeholder=オプション1'));

$option2 = $create -> createNewTag(array('type=input-text', 'name=option2', 'value=', 'id=option2', 'placeholder=オプション2'));

$option3 = $create -> createNewTag(array('type=input-text', 'name=option3', 'value=', 'id=option3', 'placeholder=オプション3'));

$option4 = $create -> createNewTag(array('type=input-text', 'name=option4', 'value=', 'placeholder=オプション4'));

$option5 = $create -> createNewTag(array('type=input-text', 'name=option5', 'value=', 'placeholder=オプション5'));

$options_length = $create -> createNewTag(array('type=input-number', 'name=options-length', 'value='));

//table create
$table_th = $create -> createNewTable(array(array('type=th', 'colspan=2', 'value=アップロードしたいQUIZ問題情報')));
$table_row1 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'style=width:300px;', 'value=学籍番号'),
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
    $td_1 = array('type=td', 'style=display:none', 'class=answerLengthRow', 'value=正解な回答の数'),
    $td_2 = array('type=td', 'style=display:none', 'class=answerLengthRow', 'value='.$answer_length)
));

$table_row5 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'value=正解な回答'),
    $td_2 = array('type=td', 'value='.$right_answer)
));
//if checkbox...
$table_row5_2 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=rightAnswer2', 'style=display:none', 'value=正解な回答2'),
    $td_2 = array('type=td', 'class=rightAnswer2', 'style=display:none', 'value='.$right_answer2)
));
$table_row5_3 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=rightAnswer3', 'style=display:none', 'value=正解な回答3'),
    $td_2 = array('type=td', 'class=rightAnswer3', 'style=display:none', 'value='.$right_answer3)
));

$table_mainrow2 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'colspan=2', 'style=font-weight:bold; text-align:center; display:none', 'class=option1stPart', 'value=不正解なオプションに関する情報'),
));

$table_row6 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option1stPart', 'style=display:none', 'value=不正解なオプション1'),
    $td_2 = array('type=td', 'class=option1stPart', 'style=display:none', 'value='.$option1)
));
$table_row7 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option1stPart', 'style=display:none', 'value=不正解なオプション2'),
    $td_2 = array('type=td', 'class=option1stPart', 'style=display:none', 'value='.$option2)
));
$table_row8 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option1stPart', 'style=display:none', 'value=不正解なオプション3'),
    $td_2 = array('type=td', 'class=option1stPart', 'style=display:none', 'value='.$option3)
));
$table_row9 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option2ndPart', 'style=display:none', 'value=不正解なオプション4 (不必須)'),
    $td_2 = array('type=td', 'class=option2ndPart', 'style=display:none', 'value='.$option4)
));
$table_row10 = $create -> createNewTable(array(
    $td_1 = array('type=td', 'class=option2ndPart', 'style=display:none', 'value=不正解なオプション5 (不必須)'),
    $td_2 = array('type=td', 'class=option2ndPart', 'style=display:none', 'value='.$option5)
));

echo $create -> createNewTable(array('type=table'));

$submitBtn =$create -> createNewTag(array('type=input-submit', 'inside=div', 'value=送信'));
echo $create -> createNewTag(array('type=div', 'value='.$submitBtn, 'class=Btn-container'));

echo $create -> formEnd();

$backHomeBtn = $create -> createNewButton(array('value=Homeへ戻る', 'class=backHomeBtn', 'nav=index.php'));
echo $create -> createNewTag(array('type=div', 'value='.$backHomeBtn, 'class=Btn-container'));

echo $create -> pageEnd();
?>
