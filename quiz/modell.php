<?php
$test = new quizClass();
$length = count($_SESSION['randSeq']);

//connection to database ...
$test -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
$test -> connection();

//setting start time ...
if ($_SESSION['idx'] === 0) {
    $test -> uploadResult(0, 0);
}

//if the answer is not correct, one life will be lost
if (isset($_POST['answer']) && $test->answerCheck($_SESSION['idx'], $_POST['answer'], $_POST['radio']) == false) {
    $_SESSION['counter']--;
    if ($_SESSION['counter'] == 0) {
        echo "<script> window.location.href='result.php'; </script>";
    }
}

//if the idx more than the length of questions, the game will be over
if ($_SESSION['idx'] >= $length) {
    echo "<script> window.location.href='result.php'; </script>";
}
//select the id of question from random sequence
$idx = $_SESSION['randSeq'][($_SESSION['idx']) % $length];
$_SESSION['idx']++;

//download question, answer options, and right answer row from database (by using id)
$row = $test -> generateQuiz($idx, $length);
$question = $row['question'];
$options = array(1=>$row['option1'], 2=>$row['option2'], 3=>$row['option3'], 4=>$row['option4']);
?>

