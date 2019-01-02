<?php

include_once ('connectionClass.php');

class quizResultClass extends connectionClass {

    public function downloadResult() {
        $query_row = "SELECT (MAX(play_time) - MIN(play_time)), COUNT(*), SUM(right_answer), (COUNT(*) - SUM(right_answer)) from quiz_result";
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        $stt->execute();
        $stt->bindColumn(1, $play_time);
        $stt->bindColumn(2, $answer_total);
        $stt->bindColumn(3, $right_answer);
        $stt->bindColumn(4, $wrong_answer);
        $stt->fetch();
        $table_datas = array($play_time, $answer_total-1, $right_answer, $wrong_answer-1); //subtraction of game start values (where id=0)
        return $table_datas;
    }
}


?>
