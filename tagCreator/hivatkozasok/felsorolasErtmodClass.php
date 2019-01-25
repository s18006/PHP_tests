<?php

require_once 'neveloClass.php';

class felsorolasErtmodClass extends neveloClass {

    public function ert_modreszes($input) {
        $result = 'Az értékelés módszere ';
        if (!empty($input) && count($input) > 1) {
            $max_len = count($input);
            for ($i = 0; $i < $max_len; $i++) {
                $input[$i] = $input[$i];
                if ($i < $max_len-2) {
                    $result = $result. self::kisnevelo($input[$i]).' '.$input[$i].', ';
                } elseif ($i === $max_len-2) {
                    $result = $result. self::kisnevelo($input[$i]).' '.$input[$i].' és '. self::kisnevelo($input[$i+1]).' ';
                } elseif ($i === $max_len-1) {
                    $result = $result.$input[$i].' ';
                }
            }
        } elseif (count($input) === 1) {
        $result = $result. self::kisnevelo($input[0]).' '.$input[0].' ';
        }
        return $result;
    }
}

?>
