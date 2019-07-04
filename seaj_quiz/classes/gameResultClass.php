<?php
require_once 'isAuthenticatedClass.php';
$auth = new isAuthenticatedClass();

require_once 'dbManagerClass.php';
class gameResultClass extends dbManagerClass {
    private $result_list = array('ゲームタイム', '答えの合計', '正解', '不正解', '章');
    private $data_list;

    public function firstTableCont($post) {
        //get quiz datas from db
        $query_row = "SELECT COUNT(*), SUM(right_answer), (COUNT(*) - SUM(right_answer)), GROUP_CONCAT(DISTINCT quizId ORDER BY quizId SEPARATOR ', ') AS articles from quiz_result where user_id = ?";
        $this -> data_list = self::downloadParams1Row($query_row, self::getSession('username'), 's', 4);
        //then add gametime to array as first element
        $gameTime = intval($post / 60) .':'. intval($post % 60);
        array_unshift($this -> data_list, $gameTime);
        $table1 = '';
        foreach ($this -> data_list as $key => $value) {
            $table1 .= '<tr> <td>'.$this -> result_list[$key].'</td><td>'.$value.'</td></tr>';
        }
        return $table1;
    }

    public function secondTableCont() {
        $query_row = "SELECT question, user_answer, right_answer from quiz_result WHERE user_id=? ORDER BY id";
        $data_list = self::downloadParams($query_row, self::getSession('username'), 's', 3);
        $table2 = '';
        foreach ($data_list as $key => $value) {
            $table2 .= '<tr><td class="id-col">'.($key + 1).'</td><td class="question-col">'.$value[0].'</td><td class="answer-col">'.$value[1].'</td>';
            $corr = $value[2] == 0 ? '不正解' : '正解';
            $table2 .= '<td class="result-col">'.$corr.'</td></tr>';
        }
        return $table2;
    }

    public function updateResult() {
        $query = "INSERT INTO game_summary(user_name, quiz_name, chapters, gameTime, total_answers, right_answers) VALUES(?, ?, ?, ?, ?, ?)";
        $upload_list = array(self::getSession('username'), 'SEA-J', $this -> data_list[4], $this -> data_list[0], $this -> data_list[1], $this -> data_list[2]);
        self::insertResult($query, $upload_list, 'ssssii');
    }

    public function getSession($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return 'notFound';
        }
    }
}

//if page is refreshed, sending user to index.php
if (!isset($_SESSION['quizIds'])) {
    header('Location: index.php');
    exit;
} else {
    $table = new gameResultClass();
    $tbody1 = $table -> firstTableCont($_POST['gameTime']);
    $tbody2 = $table -> secondTableCont();
    $table -> updateResult();
    unset($_SESSION['quizIds']); unset($_SESSION['idx']);
}
?>
