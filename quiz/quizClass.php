<?php
include_once ('connectionClass.php');

class quizClass extends connectionClass {

    public function generateQuiz($idx) {
        $query_row = "SELECT * FROM quiz WHERE id=?";
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        $stt->bindParam(1, $idx, PDO::PARAM_INT);
        $stt->execute();
        $row = $stt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function answerCheck($db_answer, $user_answer) {
        if ($db_answer != hash('sha256', json_encode($user_answer))) {
            return false;
        }
        else {
            return true;
        }
    }
}
?>
