<?php
require_once 'dbManagerClass.php';
class gameResultClass extends dbManagerClass {
    private $result_list = array('答えの合計', '正解', '不正解', '章');
    private $table1 = '';
    private $table2 = '';

    public function firstTableCont($post) {
        $this -> table1 .= '<tr> <td> ゲームタイム(秒)</td> <td>'.$post.'</td></tr>';
        $query_row = "SELECT COUNT(*), SUM(right_answer), (COUNT(*) - SUM(right_answer)), GROUP_CONCAT(DISTINCT quizId ORDER BY quizId SEPARATOR ', ') AS articles from quiz_result where user_id = ?";
        $data_list = self::downloadParams1Row($query_row, 'Tester', 's', 4);
        foreach ($data_list as $key => $value) {
            $this -> table1 .= '<tr> <td>'.$this -> result_list[$key].'</td><td>'.$value.'</td></tr>';
        }
        return $this -> table1;
    }

    public function secondTableCont() {
        $query_row = "SELECT question, user_answer, right_answer from quiz_result WHERE user_id=? ORDER BY id";
        $data_list = self::downloadParams($query_row, 'Tester', 's', 3);
        foreach ($data_list as $key => $value) {
            $this -> table2 .= '<tr><td class="id-col">'.($key + 1).'</td><td class="question-col">'.$value[0].'</td><td class="answer-col">'.$value[1].'</td>';
            $corr = $value[2] == 0 ? '不正解' : '正解';
            $this -> table2 .= '<td class="result-col">'.$corr.'</td></tr>';
        }
        return $this -> table2;
    }

}
if ($_POST['gameTime']) {
    $table = new gameResultClass();
    $tbody1 = $table -> firstTableCont($_POST['gameTime']);
    $tbody2 = $table -> secondTableCont();
}
?>
