<?php

require_once ('connectionClass.php');
class downloadClass extends connectionClass {
    public function downloadRows($query_row, $idx) {
        //egyszeru lehivashoz egy sor, a ? parameter egy integer
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        $stt->bindParam(1, $idx, PDO::PARAM_INT);
        $stt->execute();
        $row = $stt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    //egy keresesi titel eseten
    public function downloadOneTitle($query_row, $idx, $param_list) {
        //egyszeru lehivashoz egy sor, a ? parameter egy integer
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        if (is_array($idx) === false) {
            if ($param_list === 'i') {
                $stt->bindParam(1, $idx, PDO::PARAM_INT);
            } else if ($param_list === 's') {
                $stt->bindParam(1, $idx, PDO::PARAM_STR);
            }
        } else if (is_array($idx) === true) {
            for ($i = 0; $i < strlen($param_list); $i++) {
                $param_idx = $i + 1;
                if ($param_list[$i] === 'i') {
                    $stt->bindParam($param_idx, $idx[$i], PDO::PARAM_INT);
                } else if ($param_list[$i] === 's') {
                    $stt->bindParam($param_idx, $idx[$i], PDO::PARAM_STR);
                }
            }
        }
        $stt->execute();
        $title = $stt->fetch();
        return $title[0];
    }

    public function downloadRowsMultiParam($query_row, $idx, $param_list) {
        //$param_list egy string sor, $idx egy array
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        for ($i = 0; $i < strlen($param_list); $i++) {
            $param_idx = $i +1;
            if ($param_list[$i] === 'i') {
                $stt->bindParam($param_idx, $idx[$i], PDO::PARAM_INT);
            } else if ($param_list[$i] === 's') {
                $stt->bindParam($param_idx, $idx[$i], PDO::PARAM_STR);
            }
        }
        $stt->execute();
        $row = $stt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function downloadParams1Row($query_row, $idx, $param_list, $param_numbers) {
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
        $row = array();
        for ($k = 0; $k < $param_numbers; $k++) {
            $param_idx = $k + 1;
            $stt-> bindColumn($param_idx, $row[$k]);
        }
        $stt->fetch();
        return $row;
    }

    //ez az eljarasok listazasahoz keszult
    public function downloadParams($query_row, $param_numbers) {
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        $stt -> execute();
        $temp = array();
        $result = array();
        $result_idx = 0;
        for ($i = 0; $i < $param_numbers; $i++) {
            $param_idx = $i + 1;
            $stt-> bindColumn($param_idx, $temp[$i]);
        }
        while($row = $stt->fetch()) {
            for ($k = 0; $k < $param_numbers; $k++) {
                $result[$result_idx][$k] = $temp[$k];
            }
            $result_idx++;
        };
        return $result;
    }
}

?>
