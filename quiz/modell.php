<?php
require_once 'classes/quizClass.php';
require_once 'classes/quizResultClass.php';

if (isset($_POST['newgame']) || isset($_POST['answer'])) {
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

else {
    //download result of game from database...
    $result = new quizResultClass();
    $result -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
    $table_data = $result->downloadResult();
    $table_list = array('ID'=>1, 'ゲームタイム'=>$table_data[0]. '秒', '答えの合計'=>$table_data[1], '正解'=>$table_data[2], '不正解'=>$table_data[3]);
    //table_data[0] = playtime, [1] = total of answers, [2] =right answers, [3] = wrong answers
}
?>