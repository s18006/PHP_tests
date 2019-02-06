<?php
require_once 'dbManagerClass.php';

class quizResultClass extends dbManagerClass {
    public $result_list = array('ゲームタイム(秒)' =>'', '答えの合計'=> '', '正解'=>'', '不正解'=>'');
    public $userAnswers_list = array();

    public function __construct() {
        self::downloadFullGameDatas();
        self::userAnswers();
        self::createQADataTable();

    }

    public function downloadFullGameDatas() {
        $query_row = "SELECT (MAX(play_time) - MIN(play_time)), COUNT(*) -1, SUM(right_answer), (COUNT(*) - SUM(right_answer)-1) from quiz_result where user_id = ?";
        $data_list = self::downloadParams1Row($query_row, self::getSession('user_name'), 's', 4);
        $val = 0;
        foreach ($this -> result_list as $key => $value) {
            $this->result_list[$key] = $data_list[$val];
            $val++;
        }
    }

    public function userAnswers() {
        $query_row = "SELECT question, user_answer, right_answer from quiz_result WHERE user_id=? and id=?";
        for ($i = 1; $i <= $this -> result_list['答えの合計']; $i++) {
            $this -> userAnswers_list[] = self::downloadParams1Row($query_row, array(self::getSession('user_name'), $i), 'si', 3);
        }
    }

    public function createFullGameDataTable() {
        $th_content = self::createNewTable(array(
            $th_1 = array('value=ゲーム結果', 'type=th', 'colspan=2')
        ));
        foreach ($this -> result_list as $key => $value) {
            $td_content = self::createNewTable(array(
            $td_1 = array('value='.$key, 'type=td'),
            $td_2 = array('value='.$value, 'type=td'),
        ));
        }
        return self::createNewTable(array('type=table', 'class=table1'));
    }

     public function createQADataTable() {
         $th_content = self::createNewTable(array(
             $th_1 = array('type=th', 'style=min-width:60px;', 'value=問題のID'),
             $th_2 = array('type=th', 'style=min-width:250px;', 'value=問題'),
             $th_3 = array('type=th', 'style=min-width:250px;', 'value=ユーザーの答え'),
             $th_4 = array('type=th', 'style=min-width:80px;', 'value=正解　/ 不正解'),
         ));

         for ($i = 0; $i < $this->result_list['答えの合計']; $i++) {
            if ($this->userAnswers_list[$i][2] == 0) {
                $result = '不正解';
            } else {
                $result = '正解';
            }
            $td_content = self::createNewTable(array(
                $td_1 = array('value='.($i+1), 'type=td'),
                $td_2 = array('value='.$this->userAnswers_list[$i][0], 'type=td'),
                $td_3 = array('value='.$this->userAnswers_list[$i][1], 'type=td'),
                $td_4 = array('value='.$result, 'type=td')
            ));
        }
        return self::createNewTable(array('type=table', 'class=table1'));
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

    public function unsetSession($name) {
        unset($_SESSION[$name]);
    }

    public function newQuestionListSet() {
        $quiz_list = self::getSession('randSeq');
        for ($i = 0; $i < count($this->userAnswers_list); $i++) {
            if ($this->userAnswers_list[$i][2] == 1) {
                unset($quiz_list[$i]);
            }
        }
        $quiz_list = array_values($quiz_list);
        $result = '';
        //convert the quiz_list string for input-hidden tag
        if (count($quiz_list) > 0) {
            foreach ($quiz_list as $key => $value) {
                 $result .= $value.",";
            }
            $result = substr($result, 0, -1);
        }
        return $result;
    }
}

?>
