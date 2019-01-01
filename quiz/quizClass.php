<?php
include_once ('connectionClass.php');

class quizClass extends connectionClass {

    public function uploadResult($id, $right_answer) {
        $query_row = "INSERT INTO quiz_result (id, right_answer) VALUES (?, ?)";
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        $stt->bindParam(1, $id, PDO::PARAM_INT);
        $stt->bindParam(2, $right_answer, PDO::PARAM_INT);
        $stt->execute();
    }

    public function generateQuiz($idx) {
        $query_row = "SELECT * FROM quiz WHERE id=?";
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        $stt->bindParam(1, $idx, PDO::PARAM_INT);
        $stt->execute();
        $row = $stt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function answerCheck($idx, $db_answer, $user_answer) {
        if ($db_answer != hash('sha256', json_encode($user_answer))) {
            self::uploadResult($idx, 0);
            return false;
        }
        else {
            self::uploadResult($idx, 1);
            return true;
        }
    }
}
?>
