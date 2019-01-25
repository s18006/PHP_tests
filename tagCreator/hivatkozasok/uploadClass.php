<?php

require_once 'connectionClass.php';

class uploadClass extends connectionClass {
    //$id egy lista, $param_list egy stringsor
    public function insertResult($query_row, $upload_list, $param_list) {
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        if (is_array($upload_list) === true) {
            for ($i = 0; $i < strlen($param_list); $i++) {
                $param_idx = $i + 1;
                if ($param_list[$i] === 'i') {
                    $stt->bindParam($param_idx, $upload_list[$i], PDO::PARAM_INT);
                } else if ($param_list[$i] === 's') {
                    $stt->bindParam($param_idx, $upload_list[$i], PDO::PARAM_STR);
                }
            }
        } else if (is_array($upload_list) === false) {
            if ($param_list === 'i') {
                $stt->bindParam(1, $upload_list, PDO::PARAM_INT);
            } else if ($param_list === 's') {
                $stt->bindParam(1, $upload_list, PDO::PARAM_STR);
            }
        }
        $stt->execute();
    }
}
?>
