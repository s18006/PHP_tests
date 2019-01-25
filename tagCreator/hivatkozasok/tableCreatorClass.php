<?php

class tableCreatorClass {
    public function td_th_creator ($input, $id, $tagname) {
        $result = "";
        if (is_array($input)) {
            for ($i = 0; $i < count($input); $i++) {
                $id_content = "";
                if (isset($id[$i]) && is_array($id[$i])) {
                    $id_content .= self::idFiller($id[$i]);
                }
                else {
                    $id_content = self::idFiller($id);
                }
                $result .= '<'. $tagname .' '. $id_content . '>' . $input[$i] .'</'.$tagname .'>';
            }
        }
        return $result;
    }

    public function tableCreator ($input, $id, $tagname) {
        $id_content = self::idFiller($id);
        $result = '<'.$tagname.' '.$id_content. '>';
        if (is_array($input)) {
            foreach ($input as $key) {
                $result = $result.$key;
            }
        } else {
            $result = $result.$input;
        }
        $result = $result.'</'.$tagname.'>';
        return $result;
    }

    public function idFiller($id) {
        $result = '';
        if (is_array($id)) {
            foreach($id as $key) {
                if (!empty($key)) {
                    $type = explode('=', $key)[0];
                    $value = explode('=', $key)[1];
                    if ($type ==='id') {
                        $result .= 'id="'. $value .'" ';
                    }
                    if ($type === 'name') {
                        $result .= 'name="'. $value .'" ';
                    }

                    if ($type === 'class') {
                        $result .= 'class="' .$value .'" ';
                    }
                }
            }
        }
        else if (!is_array($id) && !empty($id)) {
            $type = explode('=', $id)[0];
            $value = explode('=', $id)[1];
            if ($type === 'id') {
                $result = 'id="'. $value .'" ';
            }
            if ($type === 'name') {
                $result = 'name="'. $value .'" ';
            }
            if ($type === 'class') {
                $result = 'class="' .$value .'" ';
            }
        }
        return $result;
    }
}

?>
