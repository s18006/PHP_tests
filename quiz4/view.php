<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$create = new pageCreateClass();

if (isset($_POST['user_answer'])) {
    $answerManager = new answerManagerClass ($_POST['question_type'], $_POST['answer'], $_POST['question'], $_POST['user_answer']);
}

//start download the questions and - optional - select content
$quiz = new quizClass();
//if new game just started, upload start time to db
if (isset($_POST['newgame'])) {
    $quiz -> uploadStartTime();
}

echo $quiz -> formatQuizPage();
?>
