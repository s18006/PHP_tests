<?php

require_once ('connectionClass.php');
class dbManagerClass extends connectionClass {
    //simple download of one row, if bind parameter is an integer
    public function downloadRows($query_row, $idx) {
        //egyszeru lehivashoz egy sor, a ? parameter egy integer
        $db = self::connection();
        $stt = $db->prepare($query_row);
        $stt->bindParam(1, $idx, PDO::PARAM_INT);
        $stt->execute();
        $row = $stt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    //download one title of one row
    public function downloadOneTitle($query_row, $idx, $param_list) {
        //egyszeru lehivashoz egy sor, a ? parameter egy integer
        $db = self::connection();
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
    //download one row (with *)
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
    //download one row with defined number of columns
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

    //list from table datas
    public function downloadParams($query_row, $idx, $param_list, $column_numbers) {
        $db = connectionClass::connection();
        $stt = $db->prepare($query_row);
        if (is_array($idx) === true) {
            for ($i < 0; $i < count($idx); $i++) {
                $param_idx = $i + 1;
                if ($param_list[$i] === 's') {
                    $stt -> bindParam($param_idx, $idx[$i], PDO::PARAM_STR);
                }
                if ($param_list[$i] === 'i') {
                    $stt -> bindParam($param_idx, $idx[$i], PDO::PARAM_INT);
                }
            }
        }
        if (!is_array($idx) && !empty($idx)) {
            if ($param_list === 's') {
                $stt -> bindParam(1, $idx, PDO::PARAM_STR);
            }
            if ($param_list === 'i') {
                $stt -> bindParam(1, $idx, PDO::PARAM_INT);
            }
        }
        $stt -> execute();
        $temp = array();
        $result = array();
        $result_idx = 0;
        for ($i = 0; $i < $column_numbers; $i++) {
            $param_idx = $i + 1;
            $stt-> bindColumn($param_idx, $temp[$i]);
        }
        while($row = $stt->fetch()) {
            for ($k = 0; $k < $column_numbers; $k++) {
                $result[$result_idx][$k] = $temp[$k];
            }
            $result_idx++;
        };
        return $result;
    }
    //delete rows from db
    public function deletePlease($query_row, $idx, $param_list) {
        $db = self::connection();
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
