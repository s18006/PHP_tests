<?php
require_once ('connectionClass.php');

class randSeqClass extends connectionClass {
    public $lengthOfQquiz;
    public $options = array();

    public function calcQuizRows() {
        $query_amount_questions = "SELECT * FROM quiz";
        $db = connectionClass::connection();
        $stt = $db->prepare($query_amount_questions);
        $stt->execute();
        $amountQuestions = $stt->rowCount();
        return $amountQuestions;
    }

     public function setLengthOfQuiz($length) {
        $this->lengthOfQuiz = $length;
    }

     public function randomSequence() {
        $numbers = range(1, self::calcQuizRows());
        shuffle($numbers);
        for ($i = 0; $i < $this->lengthOfQuiz; $i++) {
            array_push($this->options, $numbers[$i]);
        }
        return $this->options;
     }

     public function clearTable() {
        $query_row = "DELETE FROM quiz_result";
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        $stt->execute();
    }

}



?>
