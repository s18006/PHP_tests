<?php
require_once 'dbManagerClass.php';

class quizResultClass extends dbManagerClass {
    public $result_list = array('ゲームタイム' =>'', '答えの合計'=> '', '正解'=>'', '不正解'=>'');
    public $userAnswers_list = array();

    public function __construct() {
        self::downloadFullGameDatas();
        self::userAnswers();
        self::createQADataTable();

    }

    public function downloadFullGameDatas() {
        $query_row = "SELECT (MAX(play_time) - MIN(play_time)), COUNT(*) -1, SUM(right_answer), (COUNT(*) - SUM(right_answer)-1) from quiz_result";
        $data_list = self::downloadParams1Row($query_row, '', '', 4);
        $val = 0;
        foreach ($this -> result_list as $key => $value) {
            $this->result_list[$key] = $data_list[$val];
            $val++;
        }
    }

    public function userAnswers() {
        $query_row = "SELECT question, user_answer, right_answer from quiz_result WHERE id=?";
        for ($i = 1; $i <= $this -> result_list['答えの合計']; $i++) {
            $this -> userAnswers_list[] = self::downloadParams1Row($query_row, $i, 'i', 3);
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
/*
    public function newQuestionLIst($quiz_list) {
        $answer_list = array();
        $value = 0;
        $query_row = "SELECT right_answer FROM quiz_result where id>?";
        $db = connectionClass::connection();
        $stt = $db -> prepare($query_row);
        $stt -> bindParam(1, $value, PDO::PARAM_INT);
        $stt -> execute();
        $stt -> bindColumn(1, $temp);
        while ($row = $stt-> fetch()) {
            $answer_list[] = $row[0];
        }
        $result = self::newQuestionListSet($quiz_list, $answer_list);
        return $result;
    }

    public function newQuestionListSet($quiz_list, $answer_list) {
        foreach ($answer_list as $key => $value) {
            if ($value == 1) {
                unset($quiz_list[$key]);
            }
        }
        $quiz_list = array_values($quiz_list);
        return $quiz_list;
    }
 */
}

?>
