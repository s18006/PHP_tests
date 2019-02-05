<?php
require_once 'formatElementClass.php';
class createElementClass extends formatElementClass {

    //id array (id, name, downloaded element (for ex. price or gender) and addictionally classname) or simple element
    public function createNewHead ($id) {
        //$id a simple element or array, it can include charset setting, link to css or js file and title name => createNewHead needs special idFiller
        $id_content = self::idFiller($id);
        $result = '<!DOCTYPE html><html><head><meta charset="UTF-8">'.$id_content.'</head>';
        return $result;
    }

    public function bodySet($input) {
        if ($input === 'open') {
            return '<body>';
        }
        else if ($input === 'close') {
            return '</body></html>';
        }
    }

    public function formSet($input) {
        if (!is_array($input) && $input === 'close') {
            $result = '</form>';
        }
        if (is_array($input) && in_array('open', $input)) {
            $result = '<form ';
            foreach ($input as $key) {
                if (strpos($key, '=')) {
                   $result .= self::idFiller($key);
                }
            }
            $result .= '>';
        }
        return $result;
    }

    //if element is as simple as div tag
    public function fillSimpleElement($input, $id, $tagname) {
        $result = '<'.$tagname.' ';
        $id_content = self::idFiller($id);
        //html tag id, class es name resze
        $result = $result . $id_content . '> '. $input .'</' .$tagname .'>';
        return $result;
    }

    //for input elements, except buttons
    public function fillInputElement($input, $id, $tagname) {
        $input_tagtype = explode('-', $tagname)[1];
        $result = '<input type="'.$input_tagtype.'" ';
        $id_content = self::idFiller($id); //html tag id, class es name resze
        if (strpos($input, '=') && explode('=', $input)[0] === 'value') {
            $input = explode('=', $input)[1];
        }
        $value = 'value="' . htmlspecialchars($input) . '" ';
        $result = $result . $id_content . $value . '/>';
        return $result;
    }

    //for input button tags
    public function fillInputButtonElement($tag) {
        $result = '<input type="button" ';
        $content = self::idFiller($tag); //html tag id, class es name reszenek kitoltese
        $result .= $content . '/>';
        return $result;
    }

    //for button elements
    public function fillButtonElement($tag) {
        $result = '<button ';
        $value_content = '';
        foreach ($tag as $key => $value) {
            $type = explode('=', $value)[0];
            $text_value = substr($value, strlen($type)+1);
            if ($type === 'value') {
                $value_content = htmlspecialchars($text_value);
                unset($tag[$key]);
            }
        }
        if (count($tag) > 0) {
            $tag = array_values($tag);
        }
        $id_content = self::idFiller($tag);
        $result .= $id_content .'> ' .$value_content . '</button>';
        return $result;
    }

    public function fillIRadioCheckboxElement($input, $id, $tagname) {
        $result = '<input type="'.$tagname.'" ';
        //for formatting label... and fill input part
        //put name, id and value parts to list of input
        //put class, id to list of label
        $id_list_input = array();
        $id_list_label = array();
        foreach ($id as $key => $value) {
            $format_type = explode('=', $value)[0];
            if ($format_type === 'id') {
                $id_value = explode('=', $value)[1];
                $id_list_input[] = $value;
                $id_list_label[] = $value;
            }
            else if ($format_type === 'value' || $format_type === 'name' || $format_type='req') {
                $id_list_input[] = $value;
            }
            else if ($format_type === 'class') {
                $id_list_input[] = $value;
                $id_list_label[] = $value;
            }
        }
        $id_content_input = self::idFiller($id_list_input);
        $id_content_label = self::idFiller($id_list_label);
        $result .= $id_content_input .'/><label for="'. $id_value .'" ' .$id_content_label .'>' .$input . '</label>';
        return $result;
    }

    //input_select array(name=?, and db =?) or name=?
    //input option array($key(ami a tagok kozott jelenik meg) => array(...))
    public function createSelect($input_select, $input_option) {
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

    //find the db=? element in input_select array
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

    //delete db=? element from input_select array, and sort again the array
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
