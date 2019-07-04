<?php
require_once 'dbManagerClass.php';
class quizClass extends dbManagerClass {
    //check refresh or end case by status
    private $status = 'working';
    private $param;
    private $quizRow = array();
    private $user_content;
    private $rightAnswers = 0;

    public function __construct($post) {
        //start session anyway
        if (!isset($_SESSION)) { session_start(); }

        //decode the post
        $content = json_decode($post);
        if ($content -> type == 'withoutAnswer') {
            //in case of refresh...
            if (self::getSession('idx') > 0) {
                $this -> status = 'refreshed';
            } else {
                self::generateQuiz();
            }
        }

        if ($content -> type == 'withAnswer') {
            $this -> rightAnswers = $content -> rightAnswer;
            self::answerCheck($content -> id, $content -> answer);
            if (self::getSession('idx') >= count(self::getSession('quizIds'))) {
                $this -> status = 'end';
            }
            else {
                self::generateQuiz();
            }
        }
    }

    //user answer check
    public function answerCheck($id, $user_answer) {
        $query = "SELECT question, question_type, answer, quizId FROM quiz4 WHERE id=?";
        $result = self::downloadParams1Row($query, $id, 'i', 4);
        if ($result[1] == 'checkbox') {
            sort($user_answer);
            if (count($user_answer) == 3) {
                $temp_user_answer = htmlspecialchars($user_answer[0]).':/#'. htmlspecialchars($user_answer[1]).':/#'. htmlspecialchars($user_answer[2]);
                $user_answer = '1. '. $user_answer[0]. ', 2. ' .$user_answer[1] . ', 3. '.$user_answer[2];
            } if (count($user_answer) == 2) {
                $temp_user_answer = htmlspecialchars($user_answer[0]).':/#'. htmlspecialchars($user_answer[1]);
                $user_answer = '1. '. $user_answer[0]. ', 2. ' .$user_answer[1];
            }
            $user_answer_hashed = hash('sha256', json_encode($temp_user_answer));
        }
        if ($result[1] === 'bet-number') {
            $user_answer_hashed = hash('sha256', json_encode(intval($user_answer)));
        }

        //if answer includes other parameters
        if ($result[1] === 'bet-text') {
            $user_answer_hashed = hash('sha256', json_encode(strtolower(htmlspecialchars($user_answer))));
        }

        if ($result[1] === 'select' || $result[1] === 'select-img') {
            $user_answer_hashed = hash('sha256', json_encode(htmlspecialchars($user_answer)));
        }

        if ($result[2] != $user_answer_hashed) {
             //right answer (0 = no, 1 = yes), question, answer of user, if of quiz
             self::uploadResult(0, $result[0], $user_answer, $result[3]);
        }
        else {
            //right answer (0 = no, 1 = yes), question, answer of user, if of quiz
            self::uploadResult(1, $result[0], $user_answer, $result[3]);
            $this -> rightAnswers++;
        }
    }

     public function uploadResult($right_answer, $question, $user_answer, $quizId) {
        $query_row = "INSERT INTO quiz_result (user_id, id, quizId, right_answer, question, user_answer) VALUES (?, ?, ?, ?, ?, ?)";
        $id = self::getSession('idx');
        //username change when login process is ready
        self::insertResult($query_row, array(self::getSession('username'), $id, $quizId, $right_answer, $question, $user_answer), 'siisss');
    }

    //new question
    public function generateQuiz() {
        //the next index of random sequence list
        $idx = self::getSession('idx');
        //increse idx for the next round
        self::setSession('idx', $idx+1);
        //the next parameter of random sequence
        $this -> param = self::getSessionIfArray('quizIds', $idx);
        $query = "SELECT * FROM quiz4 WHERE id=?";
        $this -> quizRow = self::downloadRows($query, $this->param);
        self::formatQuizPage();
    }

    public function formatQuizPage() {
        $this -> user_content = '<div class="divQuestion"> <h3 class="question">' . self::getSession('idx').'/'. count(self::getSession('quizIds')) . '. ' . $this->quizRow['question'].'</h3></div>';

        if ($this -> quizRow['question_type'] === 'select' || $this->quizRow['question_type'] === 'select-img') {
            if ($this->quizRow['question_type'] === 'select-img') {
                //$this -> user_content .= '<img src="'. $this -> quizRow['path'] .'">';
            }
            //randomize sequence of options
            $tempList = [];
            foreach ($this ->quizRow as $key => $value) {
                if (substr($key, 0, 6) == 'option' && !empty($value)) {
                    $tempList[] = $value;
                }
            }
            shuffle($tempList);

            foreach ($tempList as $key => $value) {
            //define numbers of options and create a hidden input, then add to user_content value
                $this -> user_content .= '<div> <input type="radio" id="'.$key.'" name="user_answer" value="'.$value.'"> <label for="'.$key.'" id="'.$key.'">'.$value.'</label></div>';
            }
        }

        //if question_type is checkbox, the type of tags are checkbox (id is required part)
        if ($this -> quizRow['question_type'] === 'checkbox') {
            //create input hidden for js validation
            $this -> user_content .= '<input type="hidden" value="'. $this -> quizRow['checkbox_options']. '" id="checkbox_options" name="checkbox_options">';

            $tempList = [];
            foreach ($this ->quizRow as $key => $value) {
                if (substr($key, 0, 6) == 'option' && !empty($value)) {
                    $tempList[] = $value;
                }
            }
            shuffle($tempList);

            foreach ($tempList as $key => $value) {
                $this -> user_content .= '<div> <input type="checkbox" id="'.$key.'" name="user_answer[]" value="'.$value.'"> <label for="'.$key.'" id="'.$key.'"> '.$value.'</label></div>';
            }
        }

        if ($this -> quizRow['question_type'] === 'bet-number') {
            $this -> user_content .= '<div class="divAnswerInputNumber"><input type="text" id="user_answer" class="answerInputNumber" pattern="\d*" maxlength="'.$this -> quizRow['answer_length'].'" value=""></div>';
        }

        if ($this -> quizRow['question_type'] === 'bet-text') {
            $this -> user_content .= '<div class="divAnswerInputText"><input type="text" id="user_answer" class="answerInputText" maxlength="'.$this -> quizRow['answer_length'].'" value=""></div>';
        }
        $this -> user_content .= '<input type="hidden" id="question_type" value="'.$this -> quizRow['question_type'].'"> <input type="hidden" id="question_id" value="'.$this->quizRow['id'].'">';
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

    public function getUserContent() {
        $json_array = array(
            'status' => $this -> status,
            'html_content' => $this -> user_content,
            'rightAnswers' => $this -> rightAnswers,
            'total' => self::getSession('idx') - 1);
        return json_encode($json_array);
    }
}

if (isset($_POST['quizContent'])) {
    $quizClass = new quizClass($_POST['quizContent']);
    echo $quizClass->getUserContent();
}
?>
