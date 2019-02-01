<?php
require_once 'dbManagerClass.php';
class quizClass extends dbManagerClass {
    //sequence list parameter
    public $param;
    public $quizRow = array();
    public function __construct() {
        //start session anyway
        if (!isset($_SESSION)) {
            session_start();
        }
        //the next index of random sequence list
        $idx = self::getSession('idx');
        //the next parameeter of random sequence
        $this -> param = self::getSessionIfArray('randSeq', $idx);

        //if life is 0 or sequence is finished, game must be over
        if (self::getSession('life') === 0 || $idx > count(self::getSession('randSeq'))-1) {
            header ('location: result.php');
        }
        //quizRow Download from db
        $this -> quizRow = self::generateQuiz();
        //increse the index value for the next page
        self::setSession('idx', $idx+1);
        self::formatQuizPage();
    }

    public function generateQuiz() {
        $query_row = "SELECT * FROM quiz3 WHERE id=?";
        $row = self::downloadRows($query_row, $this->param);
        return $row;
    }

    public function formatQuizPage() {
        //set countdownna
        if ($this->quizRow['question_difficulty'] == 'K') {
            $countdown_seconds = json_encode(60);
        } else {
            $countdown_seconds = json_encode(90);
        }
        //create a hidden tag and define the coundowns seconds in that
        $countdownTag = self::createNewTag(array('type=input-hidden', 'name=countdownValue', 'id=countdownValue', 'value='.$countdown_seconds));
        //create question tag as h3
        $question = self::createNewTag(array('value='.$this->quizRow['question'], 'type=h3', 'inside=div', 'inside-class=divQuestion', 'class=question'));
        $hidden_question = self::createNewTag(array('value='.$this->quizRow['question'], 'type=input-hidden', 'name=question', 'class=hidden'));
        //for comparing the db answer with user answer
        $hidden_answer = self::createNewTag(array('value='.$this->quizRow['answer'], 'name=answer', 'type=input-hidden'));
        //save type of question 
        $hidden_type = self::createNewTag(array('value='.$this->quizRow['question_type'], 'name=question_type', 'type=input-hidden'));

        $user_content = '';
        //content create for variable situation
        if ($this -> quizRow['question_type'] === 'select') {
            for ($i = 1; $i <= 4; $i++)  {
                $idxOption = 'option'.$i;
                $user_content .= self::createNewIRadio(array('display='.$this->quizRow[$idxOption], 'name=user_answer', 'id='.$i, 'req=required', 'value='.$this->quizRow[$idxOption], 'inside=div'));
            }
        }
        if ($this -> quizRow['question_type'] === 'bet-number') {
            $user_content = self::createNewTag(array('type=input-text', 'pattern=\d*', 'maxlength='.$this->quizRow['answer_length'], 'value=', 'class=answerInputNumber', 'inside=div', 'inside-class=divAnswerInputNumber', 'name=user_answer', 'req=required'));
        }
        if ($this -> quizRow['question_type'] === 'bet-text') {
            $user_content = self::createNewTag(array('type=input-text', 'value=', 'class=answerInputText', 'maxlength='.$this->quizRow['answer_length'], 'inside=div', 'inside-class=divAnswerInputText', 'name=user_answer', 'req=required'));
        }
        $result = $countdownTag . $hidden_question . $hidden_type . $hidden_answer . $question . $user_content;
        return $result;
    }

    public function uploadStartTime() {
        $query_row = "INSERT INTO quiz_result (id, right_answer, question, user_answer) VALUES (?, ?, ?, ?)";
        return self::insertResult($query_row, array(0, '', '', ''), 'isss');
    }

    public function getSession($name) {
        return $_SESSION[$name];
    }

    public function getSessionIfArray($name, $idx) {
        return $_SESSION[$name][$idx];
    }

    public function setSession ($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public function setSessionIfArray($name, $idx, $value) {
        return $_SESSION[$name][$idx] = $value;
    }
}
?>
