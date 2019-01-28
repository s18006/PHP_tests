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


    public function userAnswers($game_length) {
        $query_row = "SELECT question, user_answer, right_answer from quiz_result WHERE id=?";
        $db = connectionClass::connection();
        $result = array();
        for ($i = 1; $i <= $game_length; $i++) {
            $stt = $db->prepare($query_row);
            $stt->bindParam(1, $i, PDO::PARAM_INT);
            $stt->execute();
            $stt->bindColumn(1, $result[$i-1][0]);
            $stt->bindColumn(2, $result[$i-1][1]);
            $stt->bindColumn(3, $result[$i-1][2]);
            $stt->fetch();
        }
        return $result;
    }

    public function newQuestionLIst($quiz_list) {
        $answer_list = array();
        $value = 0;
        $query_row = "SELECT right_answer FROM quiz_result where id>?";
        $db = connectionClass::connection();
        $stt = $db -> prepare($query_row);
        $stt -> bindParam(1, $value, PDO::PARAM_INT);
        $stt -> execute();
        $stt -> bindColumn(1, $temp);
        while ($row = $stt-> fetch()) {
            $answer_list[] = $row[0];
        }
        $result = self::newQuestionListSet($quiz_list, $answer_list);
        return $result;
    }

    public function newQuestionListSet($quiz_list, $answer_list) {
        foreach ($answer_list as $key => $value) {
            if ($value == 1) {
                unset($quiz_list[$key]);
            }
        }
        $quiz_list = array_values($quiz_list);
        return $quiz_list;
    }
}


?>
