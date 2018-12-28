<?php

class quizClass {
    public $options = array();
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

    public function randomSequence($length) {
        $numbers = range(1,self::calcQuizRows());
        shuffle($numbers);
        for ($i = 0; $i < $length; $i++) {
            array_push($this->options, $numbers[$i]);
        }
        return $this->options;
    }

    public function generateQuiz() {
        if (count($this->options) == 0) {
            self::randomSequence(3);
        }
        $query_row = "SELECT * FROM quiz WHERE id=?";
        $db = self::connection();
        $stt = $db->prepare($query_row);
        $stt->bindParam(1, $this->options[0], PDO::PARAM_INT);
        $stt->execute();
        $row = $stt->fetch(PDO::FETCH_ASSOC);
        array_shift($this->options);
        return $row;
    }

}



?>
