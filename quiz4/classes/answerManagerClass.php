<?php

require_once 'dbManagerClass.php';
class answerManagerClass extends quizClass {

    public function __construct($question_type, $db_answer, $question, $user_answer) {
        //checking if page is refreshed
        if (self::getSession('refreshCheck') !== 'notFound') {
            if (self::getSession('refreshCheck') === $question) {
        //if page is refreshed, send back user to newgame.php
                header('location: newgame.php');
            } else {
                self::setSession('refreshCheck', $question);
            }
        }
        if (self::getSession('life') === 0) {
            header('location: result.php');
        }
        $idx = self::getSession('idx');
        //if answer a list (only with chechbox), first convert the array to list, the hash the answer string
        if ($question_type === 'checkbox') {
            sort($user_answer);
            if (count($user_answer) === 3) {
                $temp_user_answer = $user_answer[0].':/#'.$user_answer[1].':/#'.$user_answer[2];
                $user_answer = '1. '. $user_answer[0]. ', 2. ' .$user_answer[1] . ', 3. '.$user_answer[2];
            } else {
                $temp_user_answer = $user_answer[0].':/#'.$user_answer[1];
                $user_answer = '1. '. $user_answer[0]. ', 2. ' .$user_answer[1];
            }
            $user_answer_hashed = hash('sha256', json_encode($temp_user_answer));
        }

        //if answer includes only numeric characters, the hash method is different
        if ($question_type === 'bet-number') {
            $user_answer = intval($user_answer);
            $user_answer_hashed = hash('sha256', json_encode($user_answer));
        }
        //if answer includes other parameters
        if ($question_type === 'bet-text') {
            $user_answer_hashed = hash('sha256', json_encode(strtolower($user_answer)));
        }
        if ($question_type === 'select' || $question_type === 'select-img') {
            $user_answer_hashed = hash('sha256', json_encode($user_answer));
        }
        if (self::getSession('answer_rate') === 'notFound') {
            self::setSession('answer_rate', array(0, 0));
        }
        //check user if answer and database data are equal
        if ($db_answer != $user_answer_hashed) {
             self::uploadResult(0, $question, $user_answer);
             self::setSession('life', self::getSession('life')-1);
        }
        else {
            self::uploadResult(1, $question, $user_answer);
            self::setSessionIfArray('answer_rate', 0, self::getSessionIfArray('answer_rate', 0) + 1);
        }
        self::setSessionIfArray('answer_rate', 1, self::getSessionIfArray('answer_rate', 1)+1);
    }

    public function getSession($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return 'notFound';
        }
    }

    public function getSessionIfArray($name, $idx) {
        if (isset($_SESSION[$name][$idx])) {
            return $_SESSION[$name][$idx];
        } else {
            return 'notFound';
        }
    }

    public function setSession($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function setSessionIfArray($name, $idx, $value) {
        $_SESSION[$name][$idx] = $value;
    }

    public function uploadResult($right_answer, $question, $user_answer) {
        $query_row = "INSERT INTO quiz_result (user_id, id, right_answer, question, user_answer) VALUES (?, ?, ?, ?, ?)";
        $id = self::getSession('idx');
        self::insertResult($query_row, array(self::getSession('username'), $id, $right_answer, $question, $user_answer), 'sisss');
    }
}

?>
