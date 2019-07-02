<?php
require_once 'dbManagerClass.php';
class quizClass extends dbManagerClass {
    private $param;
    private $quizRow = array();
    private $user_content;

    public function __construct($post) {
        //start session anyway
        if (!isset($_SESSION)) { session_start(); }

        //decode the post
        $content = json_decode($post);
        if ($content -> type == 'withoutAnswer') {
            self::generateQuiz();
        }
    }

    public function generateQuiz() {
        //the next index of random sequence list
        $idx = self::getSession('idx');
        //increse idx for the next round
        self::setSession('idx', $idx+1);
        //the next parameeter of random sequence
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
            $this -> user_content .= '<div class="divAnswerInputNumber"><input type="text" id="user_answer" class="answerInputNumber" pattern="\d*" maxlength="'.$this -> quizRow['answer_length'].'"></div>';
        }

        if ($this -> quizRow['question_type'] === 'bet-text') {
            $this -> user_content .= '<div class="divAnswerInputText"><input type="text" id="user_answer" class="answerInputText" maxlength="'.$this -> quizRow['answer_length'].'"></div>';
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
            'content' => 'content',
            'html_content' => $this -> user_content);
        return json_encode($json_array);
    }
}

if (isset($_POST['quizContent'])) {
    $quizClass = new quizClass($_POST['quizContent']);
    echo $quizClass->getUserContent();
}

?>
