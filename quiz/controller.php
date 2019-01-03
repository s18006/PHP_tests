<?php
//autoload the classes from classes folder...
function myAutoload($class_name) {
  require_once 'classes/' . $class_name . '.php';
}
spl_autoload_register('myAutoload');

//separate codes by uri
$action = explode('/else/quiz/', htmlspecialchars($_SERVER['REQUEST_URI']))[1];
//if new game starts...
if ($action === 'newgame.php') {
    $randSeq = new randSeqClass ();
    $randSeq -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
    $randSeq -> connection();
    $randSeq -> clearTable(); //clear the last game result
    $randSeq -> setLengthOfQuiz(8); //length of play (number of questions)
    //define random sequence as session array
    $_SESSION['randSeq'] = $randSeq->randomSequence();
    //define index as session in order to change the question and answer options
    $_SESSION['idx'] = 0;
    //define 3life points
    $_SESSION['counter'] = 3;
}

//if game is played...
if ($action === 'view.php') {
    $test = new quizClass();
    $length = count($_SESSION['randSeq']);

    //connection to database ...
    $test -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
    $test -> connection();

    //setting start time ...
    if (isset($_POST['newgame'])) {
        $test -> uploadResult(0, 0);
    }

    if (isset($_POST['answer'])) {
        //if the answer is not correct, one life will be lost
        $_SESSION['counter'] = $test->answerCheck($_SESSION['idx'], $_POST['answer'], $_POST['radio'], $_SESSION['counter']);
        //if life is 0, the game is over...
        if ($_SESSION['counter'] === 0) {
        echo "<script> window.location.href='result.php'; </script>";
        }

        //if the idx more than the length of questions, the game will be over
        if ($_SESSION['idx'] >= $length) {
            echo "<script> window.location.href='result.php'; </script>";
        }

    }
    //select the id of question from random sequence
    $idx = $_SESSION['randSeq'][($_SESSION['idx']) % $length];
    $_SESSION['idx']++;

    //download question, answer options, and right answer row from database (by using id)
    $row = $test -> generateQuiz($idx, $length);
    $question = $row['question'];
    $options = array(1=>$row['option1'], 2=>$row['option2'], 3=>$row['option3'], 4=>$row['option4']);
}

//if game is over...
if ($action === 'result.php') {
    //download result of game from database...
    $result = new quizResultClass();
    $result -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
    $table_data = $result->downloadResult();
    $table_list = array('ID'=>1, 'ゲームタイム'=>$table_data[0]. '秒', '答えの合計'=>$table_data[1], '正解'=>$table_data[2], '不正解'=>$table_data[3]);
    //table_data[0] = playtime, [1] = total of answers, [2] =right answers, [3] = wrong answers
}
?>
