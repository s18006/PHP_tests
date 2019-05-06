<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$create = new pageCreateClass();

//if page was refreshed go back to newgame.php

if (isset($_POST['user_answer'])) {
    $answerManager = new answerManagerClass ($_POST['question_type'], $_POST['answer'], $_POST['question'], $_POST['user_answer']);
}

//start download the questions and - optional - select content
$quiz = new quizClass();
//if new game just started, upload start time to db and if page is refreshed, we send back user to newgame.php
if (isset($_POST['newgame'])) {
    $quiz -> uploadStartTime($_POST['newgame']);
}

echo $quiz -> formatQuizPage();
?>
