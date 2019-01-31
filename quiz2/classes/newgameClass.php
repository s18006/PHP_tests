<?php
require_once 'dbManagerClass.php';
class newgameClass extends dbManagerClass {
    public $lengthOfQuiz = 10;

    public function __construct() {
        self::randomSequence();
        self::setSession('life', 3);
        self::setSession('idx', 0);
    }

    public function calcQuizRows() {
        $query_title = "SELECT COUNT(id) FROM quiz2 WHERE id > ?";
        $amountQuestions = self::downloadOneTitle($query_title, 0, 'i');
        return $amountQuestions;
    }

    public function randomSequence() {
        self::setSession('randSeq', array());
        self::clearTable();
        $numbers = range(1, self::calcQuizRows());
        shuffle($numbers);
        for ($i = 0; $i < $this->lengthOfQuiz; $i++) {
            self::setSessionAsArray('randSeq', $numbers[$i]);
        }
     }

    public function clearTable() {
        $query = 'DELETE FROM quiz_result';
        return self::deletePlease($query, '', '');
    }

    public function getSession($name) {
        return $_SESSION[$name];
    }

    public function setSession($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public function setSessionAsArray($name, $value) {
        return $_SESSION[$name][] = $value;
    }
}

?>
