<?php
require_once 'tableCreatorClass.php';
class createElementClass extends tableCreatorClass {

    //id array (id, name, downloaded element (for ex. price or gender) and addictionally classname) or simple element
    public function createNewElement($input, $type, $id) {
        //szimpla html tag letrehozasa tag + input
        $simple_element = array('div', 'p', 'h1', 'h2', 'textarea', 'header', 'tr');
        //itt a value miatt az eljaras kicsit mas
        $main_input_element = array('input-text', 'input-date', 'input-number', 'input-tel', 'input-email', 'input-datetime-local', 'input-submit');
        if (in_array($type, $simple_element)) {
            return self::fillSimpleElement($input, $id, $type);
        }

        if (in_array($type, $main_input_element)) {
            return self::fillInputElement($input, $id, $type);
        }
        //table ket vaz resze
        if ($type === 'table' || $type === 'tbody') {
            return self::tableCreator($input, $id, $type);
        }
        //select teljesen spec emiat kulon fuggveny
        if ($type === 'select' && is_array($input) === true) {
            return self::createSelect($input, $id);
        }
        //table th es td resze soron belul ismetlodhet
        if ($type === 'th' || $type === 'td') {
            return self::td_th_creator($input, $id, $type);
        }

        if ($type === 'input-button') {
            return self::fillInputButtonElement($input, $id, $type);
        }

        if ($type === 'button') {
            return self::fillButtonElement($input, $id, $type);
        }
    }

    public function fillSimpleElement($input, $id, $tagname) {
        $result = '<'.$tagname.' ';
        $id_content = self::idFiller($id);
        //html tag id, class es name resze
        $result = $result . $id_content . '> '. $input .'</' .$tagname .'>';
        return $result;
    }

    public function fillInputElement($input, $id, $tagname) {
        $input_tagtype = explode('-', $tagname)[1];
        $result = '<input type="'.$input_tagtype.'" ';
        $id_content = self::idFiller($id); //html tag id, class es name resze
        $value = 'value="' . htmlspecialchars($input) . '" ';
        $result = $result . $id_content . $value . '></input>';
        return $result;
    }

    public function fillInputButtonElement($input, $id, $type) {
        $result = '<input type="button" ';
        $id_content = self::idFiller($id); //html tag id, class es name reszenek kitoltese
        $value="";
        $onclick = "";
        if (is_array($input)) {
            $value = 'value="' .$input[0].'" ';
            if (isset($input[1]) && !empty($input[1])) {
                $onclick = 'onClick="'.$input[1].'" ';
            }
        }
        if(!is_array($input)) {
            $value = 'value="' .$input.'" ';
        }

        $result = $result . $id_content . $value . $onclick. '/>';
        return $result;
    }


    public function fillButtonElement($input, $id, $tagname) {
        $result = '<button ';
        $value_content = '';
        $onclick_content = '';
        $id_content = self::idFiller($id);
        if (is_array($input)) {
            if (isset($input[0]) && !empty($input[0])) {
                $value_content = htmlspecialchars($input[0]);
            }
            if (isset($input[1]) && !empty($input[1])) {
                $onclick_content = 'onclick="'. $input[1] . '" ';
            }
        }
        else {
            $value_content = htmlspecialchars($input);
        }
        $result .= $onclick_content . $id_content .'> ' .$value_content . '</button>';
        return $result;
    }

    //a html tag id, class es name kitoltesehez (id array 1. eleme, name 2. eleme, class 3. eleme)

    public function createOption($key, $value) {
        $result = '<option value="'. htmlspecialchars($key).'">'. htmlspecialchars($value) .'</option>';
        return $result;
    }

    public function createSelect($input, $id) {
        $result = array('<select id="'.$id.'">');
        foreach ($input as $key => $value) {
            $result[] = self::createOption($key, $value);
        }
        $result[] = '</select>';
        return $result;
    }
}

?>
