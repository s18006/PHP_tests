<?php
require_once 'dbManagerClass.php';
class newgameClass extends dbManagerClass {
    public $lengthOfQuiz;
    public $repeatSeq = array();

    public function __construct($post) {
        self::clearRefreshCheck();
        self::gameTypeSetting();
        self::getRepeatSeq($post);
        self::randomSequence();
        self::setSession('life', 3);
        self::setSession('idx', 0);
    }

    public function clearRefreshCheck() {
        if (self::getSession('refreshCheck') != 'notFound') {
            self::setSession('refreshCheck', '');
        }
    }


    public function gameTypeSetting() {
        if(isset($_POST['newgame']) && isset($_POST['db_type'])) {
            self::setSession('gameType', $_POST['newgame']);
            self::setSession('dbType', $_POST['db_type']);
        }
    }

    public function calcQuizRows() {
        if (self::getSession('dbType') === 'IT Fundamental') {
            $query_title = "SELECT COUNT(id) FROM ITFUND WHERE id > ?";
        } else {
            $query_title = "SELECT COUNT(id) FROM quiz4 WHERE id > ?";
        }
        $amountQuestions = self::downloadOneTitle($query_title, 0, 'i');
        //setting length of quiz
        if (self::getSession('gameType') === 'shortGame') {
            $this -> lengthOfQuiz = 10;
        } else{
            $this -> lengthOfQuiz = $amountQuestions;
        }
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
            while (count(self::getSession('randSeq')) < $this -> lengthOfQuiz) {
                if (is_array($this -> repeatSeq) && $idx <= $maxvalue) {
                    self::setSessionAsArray('randSeq', $idx, $this->repeatSeq[$idx]);
                    unset($this -> repeatSeq[$idx]);
                    $idx++;
                } else {
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
        if (self::getSession('username') !== 'notFound') {
            $query = 'DELETE FROM quiz_result WHERE user_id = ?';
            return self::deletePlease($query, self::getSession('username'), 's');
        }
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
