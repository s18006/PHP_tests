<?php
$test = new quizClass();
$length = count($_SESSION['randSeq']);
if (isset($_POST['answer']) && $test->answerCheck($_POST['answer'], $_POST['radio']) == false) {
    $_SESSION['counter']--;
    if ($_SESSION['counter'] == 0) {
        echo "<script> window.location.href='result.php'; </script>";
    }

}
$test -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
$test -> connection();
$idx = $_SESSION['randSeq'][($_SESSION['idx']) % $length];
$_SESSION['idx']++;
if ($_SESSION['idx'] > $length) {
    echo "<script> window.location.href='result.php'; </script>";
}
$row = $test -> generateQuiz($idx, $length);
$question = $row['question'];
$options = array(1=>$row['option1'], 2=>$row['option2'], 3=>$row['option3'], 4=>$row['option4']);
?>

