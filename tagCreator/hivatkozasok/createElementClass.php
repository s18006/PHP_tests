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
    //input_select array(name=?, and db =?) or name=?
    //input option array($key(ami a tagok kozott jelenik meg) => array(...))
    public function createSelect($input_option, $input_select) {
        $input_select_pure = self::dbFilter($input_select);
        $select_content = self::idFiller($input_select_pure);
        $checkdata = self::dbElementFinder($input_select);
        $option_content = self::createOption($checkdata, $input_option);
        $result = '<select '. $select_content.'>'. $option_content . '</select>';
        return $result;
    }

    public function createOption($checkdata, $input) {
        $result = "";
        foreach ($input as $key => $value) {
            $value_content = self::idFiller($value);
            if (in_array($checkdata, $value)) {
                $value_content .= self::idFiller('req=selected');
            }
            $result .= '<option ' .$value_content . '>'.$key.'</option>';
        }
        return $result;
    }

    public function dbElementFinder($input) {
        $result = '';
        if (is_array($input)) {
            foreach ($input as $key) {
                if (substr($key, 0, 2) === 'db') {
                    $result = 'value='. explode('=', $key)[1];
                }
            }
        }
        if (!is_array($input) && substr($input, 0, 2) === 'db') {
            $result = 'value=' .explode('=', $input)[1];
        }
        return $result;
    }

    public function dbFilter($input) {
        if (is_array($input)) {
            for ($i = 0; $i < count($input); $i++) {
                 if (substr($input[$i], 0, 2) === 'db') {
                     unset($input[$i]);
                }
            }
            $input = array_values($input);
        }
        if (!is_array($input) && substr($input, 0, 2) === 'db') {
            $input == '';
        }
        return $input;
    }
}

?>
