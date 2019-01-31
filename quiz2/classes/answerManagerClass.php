<?php

require_once 'dbManagerClass.php';
class answerManagerClass extends quizClass {

    public function __construct($question_type, $db_answer, $question, $user_answer) {
        if (self::getSession('life') ===0) {
            header('location: result.php');
        }
        $idx = self::getSession('idx');
        //if answer includes only numeric characters, the hash method is different
        if ($question_type === 'bet-number') {
            $user_answer = intval($user_answer);
            $user_answer_hashed = hash('sha256', json_encode($user_answer));
        }
        //if answer includes other parameters
        if ($question_type === 'bet-text') {
            $user_answer_hashed = hash('sha256', json_encode(strtolower($user_answer)));
        }
        else {
            $user_answer_hashed = hash('sha256', json_encode($user_answer));
        }

        if ($db_answer !== $user_answer_hashed) {
             self::uploadResult('不正解', $question, $user_answer);
             self::setSession('life', self::getSession('life')-1);
        }
        else {
            self::uploadResult('正解', $question, $user_answer);
        }
    }

    public function uploadResult($right_answer, $question, $user_answer) {
        $query_row = "INSERT INTO quiz_result (id, right_answer, question, user_answer) VALUES (?, ?, ?, ?)";
        $id = self::getSession('idx');
        self::insertResult($query_row, array($id, $right_answer, $question, $user_answer), 'isss');
    }
}



?>
