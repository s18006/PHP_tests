<?php

require_once 'dbManagerClass.php';

class exitGameClass extends dbManagerClass {
    public function __construct() {
        self::clearTable();
        if (self::getSession('answer_rate') !== 'notFound') {
            $query_answerRate = "INSERT INTO game_summary (user_name, quiz_name, total_answers, right_answers) VALUES (?, ?, ?, ?)";
            $user_name = self::getSession('user_name');
            $quiz_name = 'quiz4';
            $total_answers = self::getSessionIfArray('answer_rate', 1);
            $right_answers = self::getSessionIfArray('answer_rate', 0);
            self::insertResult($query_answerRate, array($user_name, $quiz_name, $total_answers, $right_answers), 'ssii');
        }
        self::sessionDestroy();
    }

     public function clearTable() {
        if (self::getSession('user_name') !== 'notFound') {
            $query = 'DELETE FROM quiz_result WHERE user_id = ?';
            return self::deletePlease($query, self::getSession('user_name'), 's');
        }
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

    public function sessionDestroy() {
        return session_destroy();
    }
}
?>
