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
        self::formatQuizPage();
        self::setSession('idx', $idx+1);
    }

    public function generateQuiz() {
        $query_row = "SELECT * FROM quiz4 WHERE id=?";
        $row = self::downloadRows($query_row, $this->param);
        return $row;
    }

    public function formatQuizPage() {
        //set countdown
        if ($this->quizRow['question_difficulty'] == 'K') {
            $countdown_seconds = json_encode(60);
        } else {
            $countdown_seconds = json_encode(90);
        }

        //create pageStart part if question type is checkbox
        if ($this -> quizRow['question_type'] === 'checkbox') {
            $pageOpen = self::pageStart(
                $head_part = array('title=Quiz Game', 'link_css=css/view_style.css', 'link_js=js/formValidate.js', 'link_js=js/countdown.js'),
                $form_part = array('open', 'onsubmit=return formValidate();', 'method=post', 'action=self')
            );
        }
        //create pageStart if question type is not checkbox
        else {
             $pageOpen = self::pageStart(
                $head_part = array('title=Quiz Game', 'link_css=css/view_style.css', 'link_js=js/countdown.js'),
                $form_part = array('open', 'method=post', 'action=self')
            );
        }
        $total_counter_value = '正解：-, 合計: -';
        if (self::getSession('answer_rate') !== 'notFound') {
            $total = self::getSessionIfArray('answer_rate', 1);
            $right = self::getSessionIfArray('answer_rate', 0);
            $total_counter_value = '正解：'. $right . ', 合計: '. $total .' 正解確率: ' . round($right/$total, 4) * 100 . '%';
        }
        //create life display element
        $timeLabel = self::createNewTag(array(
            $time = array('type=span', 'value=', 'id=countdown', 'class=timer', 'inside-class=timer_text', 'inside-value=Remaining time: ', 'inside=p'),
            $life = array('type=p', 'style=font-size: 16px; font-weight: bold;', 'value=Remaining life: '. self::getSession('life')),
            $total_counter = array('type=p', 'style=font-weight:bold; width: 260px; background:gray; color:white; font-size:16px;', 'value='.$total_counter_value),
            $supportText = array('type=p', 'id=supportText', 'class=supportText', 'value=頑張って'.self::getSession('user_name').'さん')));

        //create a hidden tag and define the coundowns seconds in that
        $countdownTag = self::createNewTag(array('type=input-hidden', 'name=countdownValue', 'id=countdownValue', 'style=display:none;', 'value='.$countdown_seconds));
        //create question tag as h3
        $question = self::createNewTag(array('value='. self::getSession('idx') . '/'. count(self::getSession('randSeq')). '. ' . $this->quizRow['question'], 'type=h3', 'inside=div', 'inside-class=divQuestion', 'class=question'));
        $hidden_question = self::createNewTag(array('value='.$this->quizRow['question'], 'type=input-hidden', 'name=question', 'class=hidden'));
        //for comparing the db answer with user answer
        $hidden_answer = self::createNewTag(array('value='.$this->quizRow['answer'], 'name=answer', 'type=input-hidden'));
        //save type of question
        $hidden_type = self::createNewTag(array('value='.$this->quizRow['question_type'], 'name=question_type', 'type=input-hidden'));

        $user_content = '';
        //content create for variable situation
        if ($this -> quizRow['question_type'] === 'select' || $this->quizRow['question_type'] === 'select-img') {
            if ($this->quizRow['question_type'] === 'select-img') {
                $user_content .= self::createNewTag(array('type=img', 'src=images/'.$this->quizRow['id'].'.png', 'value='));
            }
            for ($i = 1; $i <= 4; $i++)  {
                //define numbers of options and create a hidden input, then add to user_content value
                $idxOption = 'option'.$i;
                $user_content .= self::createNewIRadio(array('display='.$this->quizRow[$idxOption], 'name=user_answer', 'id='.$i, 'req=required', 'value='.$this->quizRow[$idxOption], 'inside=div'));
            }
        }
        //if question_type is checkbox, the type of tags are checkbox (id is required part)
        if ($this -> quizRow['question_type'] === 'checkbox') {
            $user_content .= self::createNewTag(array('type=input-hidden', 'value='.$this->quizRow['checkbox_options'], 'name=checkbox_options', 'style=display:none;', 'id=checkbox_options'));
            for ($i = 1; $i <= $this->quizRow['checkbox_length']; $i++) {
                $idxOption = 'option'.$i;
                $user_content .= self::createNewCheckbox(array('display='.$this->quizRow[$idxOption], 'name=user_answer[]', 'id='.$i, 'value='.$this->quizRow[$idxOption], 'inside=div'));
            }
        }
        //if question type is bet number, the type of tag is input-text (only for numbers)
        if ($this -> quizRow['question_type'] === 'bet-number') {
            $user_content = self::createNewTag(array('type=input-text', 'pattern=\d*', 'maxlength='.$this->quizRow['answer_length'], 'value=', 'class=answerInputNumber', 'inside=div', 'inside-class=divAnswerInputNumber', 'name=user_answer', 'req=required'));
        }
        //if question type is bet text, the type of tag is input-text
        if ($this -> quizRow['question_type'] === 'bet-text') {
            $user_content = self::createNewTag(array('type=input-text', 'value=', 'class=answerInputText', 'maxlength='.$this->quizRow['answer_length'], 'inside=div', 'inside-class=divAnswerInputText', 'name=user_answer', 'req=required'));
        }

        $submitBtn = self::createNewTag(array('type=input-submit', 'inside=div', 'inside-class=div_quizSubmitBtn', 'value=送信', 'id=answerBtn', 'class=answerBtn'));
//close the form and the page
        $formEnd = self::formEnd();
        $pageEnd = self::pageEnd();

        //create the page content as $result
        $result = $pageOpen . $timeLabel . $countdownTag . $hidden_question . $hidden_type . $hidden_answer . $question . $user_content . $submitBtn . $formEnd . $pageEnd;
        return $result;
    }

    public function uploadStartTime() {
        $query_row = "INSERT INTO quiz_result (user_id, id, right_answer, question, user_answer) VALUES (?, ?, ?, ?, ?)";
        return self::insertResult($query_row, array(self::getSession('user_name'), 0, '', '', ''), 'sisss');
    }

    public function getSession($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return 'notFound';
        }
    }

    public function getSessionIfArray($name, $idx) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name][$idx];
        } else {
            return 'notFound';
        }
    }

    public function setSession ($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public function setSessionIfArray($name, $idx, $value) {
        return $_SESSION[$name][$idx] = $value;
    }
}
?>
