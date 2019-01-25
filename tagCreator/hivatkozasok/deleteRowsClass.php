<?php
require_once 'connectionClass.php';

class deleteRowsClass extends connectionClass {
    //az idx a parameterek csoportja, vagy egy parameter, a param_list a parmeterek tipuslistaja
    public function deletePlease($query_row, $idx, $param_list) {
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        if (is_array($idx) === true) {
             for ($i = 0; $i < strlen($param_list); $i++) {
                $param_idx = $i + 1;
                if($param_list[$i] === 's') {
                    $stt->bindParam($param_idx, $idx[$i], PDO::PARAM_STR);
                }
                else if ($param_list[$i] === 'i') {
                    $stt->bindParam($param_idx, $idx[$i], PDO::PARAM_INT);
                }
            }
        } else if (is_array($idx) === false) {
            if ($param_list === 's') {
                $stt->bindParam(1, $idx, PDO::PARAM_STR);
            } else if ($param_list === 'i') {
                $stt->bindParam(1, $idx, PDO::PARAM_INT);
            }
        }
        $stt -> execute();
    }
}



?>
