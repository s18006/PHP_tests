<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$create = new pageCreateClass();

//save user_name before donwnloading the first question
if (isset($_POST['user_name'])) {
    $conn -> addSession('user_name', $_POST['user_name']);
}

if (isset($_POST['user_answer'])) {
    $answerManager = new answerManagerClass ($_POST['question_type'], $_POST['answer'], $_POST['question'], $_POST['user_answer']);
}

//start download the questions and - optional - select content
$quiz = new quizClass();
//if new game just started, upload start time to db
if (isset($_POST['newgame'])) {
    $quiz -> uploadStartTime();
}

echo $create -> pageStart(
    $head_part = array('title=Quiz Game', 'link_css=css/view_style.css', 'link_js=js/countdown.js'),
    $form_part = array('open', 'method=post', 'action=self')
);
//create life display element
echo $create -> createNewTag(array(
    $time = array('type=span', 'value=', 'id=countdown', 'class=timer', 'inside-class=timer_text', 'inside-value=Remaining time: ', 'inside=p'),
    $life = array('type=p', 'style=font-size: 16px; font-weight: bold;', 'value=Remaining life: '.$quiz ->getSession('life')),
    $supportText = array('type=p', 'id=supportText', 'class=supportText', 'value=頑張って'.$quiz->getSession('user_name').'さん')));

echo $quiz -> formatQuizPage();

//create submit button
echo $create -> createNewTag(array('type=input-submit', 'inside=div', 'inside-class=div_quizSubmitBtn', 'value=送信', 'id=answerBtn', 'class=answerBtn'));
//close the form and the page
echo $create -> formEnd();
echo $create -> pageEnd();

?>
