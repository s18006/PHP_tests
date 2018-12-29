<?php

class quizClass {
    public $options = array();
    public $idx = 0; //index of questions
    public $lengthOfQquiz;
    public $dsn; //mysql, localhost, dbname test
    public $usr;
    public $password;
    public $amountQuestions = 0;

    //setting the PDO datas (db datas, username, password)
    public function setPDO_datas ($dsn, $usr, $password) {
        $this->dsn = $dsn;
        $this->usr = $usr;
        $this->password = $password;
    }

    //PDO connection
    public function connection() {
        try {
        $db = new PDO($this->dsn, $this->usr, $this->password);
        } catch (PDOException $e) {
            exit("データベースに接続できません。: {$e->getMessage()}");
        }
        return $db;
    }

    public function calcQuizRows() {
        $query_amount_questions = "SELECT * FROM quiz";
        $db = self::connection();
        $stt = $db->prepare($query_amount_questions);
        $stt->execute();
        $this->amountQuestions = $stt->rowCount();
        return $this->amountQuestions;
    }

    public function setLengthOfQuiz($length) {
        $this->lengthOfQuiz = $length;
    }
    //list for sequence of questions
    public function randomSequence() {
        $numbers = range(1, self::calcQuizRows());
        shuffle($numbers);
        for ($i = 0; $i < $this->lengthOfQuiz; $i++) {
            array_push($this->options, $numbers[$i]);
        }
        return $this->options;
    }

    public function generateQuiz() {
        if ($this->idx == 0) {
            self::randomSequence();
        }
        $query_row = "SELECT * FROM quiz WHERE id=?";
        $db = self::connection();
        $stt = $db->prepare($query_row);
        $stt->bindParam(1, $this->options[$this->idx], PDO::PARAM_INT);
        $stt->execute();
        $row = $stt->fetch(PDO::FETCH_ASSOC);
        return $row;
        if ($this->idx == $this->lengthOfQuiz - 1) {
            $this->idx = 0;
        } else {
            $this->idx++;
        }
    }

    public function answerCheck($db_answer, $user_answer) {
        if ($db_answer != hash('sha256', json_encode($user_answer))) {
            return false;
        }
        else {
            return true;
        }
    }
}
?>
