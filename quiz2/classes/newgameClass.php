<?php
require_once 'dbManagerClass.php';
class newgameClass extends dbManagerClass {
    public $lengthOfQuiz = 10;
    public $repeatSeq = array();

    public function __construct($post) {
        self::getRepeatSeq($post);
        self::randomSequence();
        self::setSession('life', 3);
        self::setSession('idx', 0);
    }

    public function calcQuizRows() {
        $query_title = "SELECT COUNT(id) FROM quiz3 WHERE id > ?";
        $amountQuestions = self::downloadOneTitle($query_title, 0, 'i');
        return $amountQuestions;
    }

    public function getRepeatSeq($post) {
        if (strpos($post, ',')) {
            $this -> repeatSeq = explode(',', $post);
        }
    }

    public function randomSequence() {
        self::setSession('randSeq', array());
        self::clearTable();
        $numbers = range(1, self::calcQuizRows());
        shuffle($numbers);
        if (count($this->repeatSeq) > 0) {
            $maxvalue = count($this -> repeatSeq) - 1;
            $idx = 0;
            $val = 0;
            while (count(self::getSession('randSeq')) <= $this -> lengthOfQuiz) {
                if (is_array($this -> repeatSeq) && $idx <= $maxvalue) {
                    self::setSessionAsArray('randSeq', $idx, $this->repeatSeq[$idx]);
                    unset($this -> repeatSeq[$idx]);
                    $idx++;
                } else{
                    $val = $val % $this -> lengthOfQuiz;
                    if (!in_array($numbers[$val], self::getSession('randSeq'))) {
                        self::setSessionAsArray('randSeq', $idx, $numbers[$val]);
                        $idx++;
                    }
                    $val++;
               }
            }
        }
        else {
            for ($i = 0; $i < $this -> lengthOfQuiz; $i++) {
                self::setSessionAsArray('randSeq', $i, $numbers[$i]);
            }
        }
    }

    public function clearTable() {
        $query = 'DELETE FROM quiz_result';
        return self::deletePlease($query, '', '');
    }

    public function getSession($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return 'notFound';
        }
    }

    public function getSessionIfArray($name, $value) {
        if (isset($_SESSION[$name][$value])) {
            return $_SESSION[$name][$value];
        } else {
            return 'notFound';
        }
    }

    public function setSession($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public function setSessionAsArray($name, $idx, $value) {
        return $_SESSION[$name][$idx] = $value;
    }
}

?>
