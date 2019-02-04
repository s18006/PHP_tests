<?php

class formatElementClass {

    //formatTableStructure connects to function of createNewTable
    public function formatTableStructure($tag) {
        foreach ($tag as $key => $value) {
            if (explode('=', $value)[0] === 'type') {
                $tagname = substr($value, 5);
                unset($tag[$key]);
            }
        }
        if (count($tag) > 0) {
            $tag = array_values($tag);
        }
        if ($tagname === 'tbody') {
            $input = $this->td_content;
            $this -> td_content = '';
        }
        if ($tagname === 'table') {
            if (empty($this -> tbody_content)) {
                $input = array($this -> th_content, $this -> td_content);
                $this -> th_content = ''; $this -> td_content = '';
            }
            if (!empty($this -> tbody_content))  {
                $input = array($this -> th_content, $this -> tbody_content);
                $this -> th_content = ''; $this ->tbody_content = '';
            }
        }
        return self::tableCreator($input, $tag, $tagname);
    }

    //formatTablePart connects to function of createNewTable
    public function formatTablePart($tag) {
        $contentList = array('type=td', 'type=th');
        for ($i = 0; $i < count($tag); $i++)  {
            foreach ($tag[$i] as $key => $value) {
                if (in_array($value, $contentList)) {
                    $tagname = substr($value, 5);
                    unset($tag[$i][$key]);
                }
                if (explode('=', $value)[0] === 'value') {
                    $input[] = substr($value, 6);
                    unset($tag[$i][$key]);
                }
            }
            if (count($tag[$i]) > 0) {
                $tag[$i] = array_values($tag[$i]);
            }
        }
        return self::td_th_creator($input, $tag, $tagname);
    }


    //this function connects to formatTablePart and createNewElement functions
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
        return '<tr>'.$result.'</tr>';
    }

    //tableCreator connects to createNewElement function (old version)
    public function tableCreator ($input, $id, $tagname) {
        $id_content = self::idFiller($id);
        $result = '<'.$tagname.' '.$id_content. '>';
        if (is_array($input)) {
            foreach ($input as $key) {
                if (is_array($key)) {
                    foreach ($key as $inside_key) {
                        $result .= $inside_key;
                    }
                }
                else {
                    $result .= $key;
                }
            }
        } else {
            $result .= $input;
        }
        $result .= '</'.$tagname.'>';
        return $result;
    }

    //main function
    public function idFiller($id) {
        $result = '';
        $head_types = array('charset', 'title', 'link_js', 'link_css');
        $form_types = array('action', 'method');
        $button_types = array('nav', 'onClick', 'value');
        if (is_array($id)) {
            foreach($id as $key) {
                if (!empty($key)) {
                    $type = explode('=', $key)[0];
                    $value = substr($key, strlen($type)+1);
                    if ($type ==='req') {
                        $result .= $value .' ';
                    }
                    else if (in_array($type, $form_types)) {
                        $result .= self::formatForm($type, $value);
                    }
                    else if (in_array($type, $head_types)) {
                        $result .= self::formatHead($type, $value);
                    }
                    else if(in_array($type, $button_types)) {
                        $result .= self::formatButton($type, $value);
                    }
                    else {
                        $result .= self::formatSet($type, $value);
                    }
                }
            }
        }
        else if (!is_array($id) && !empty($id)) {
            $type = explode('=', $id)[0];
            $value = substr($id, strlen($type)+1);
            if ($type === 'req') {
                $result = $value .' ';
            }
            else if (in_array($type, $head_types)) {
                $result = self::formatHead($type, $value);
            }
            else if (in_array($type, $form_types)) {
                $result = self::formatForm($type, $value);
            }
            else if (in_array($type, $button_types)) {
                $result = self::formatButton($type, $value);
            }
            else {
                $result = self::formatSet($type, $value);
            }
        }
        return $result;
    }
    public function formatSet($type, $value) {
        return $type.'="'.$value.'" ';
    }

    public function formatHead($type, $value) {
        if ($type === 'title') {
            $result = '<title>'.$value.'</title>';
        }
        else if ($type === 'link_js') {
            $result = '<script language="javascript" src="'.$value.'"></script>';
        }
        else if ($type === 'link_css') {
            $result = '<link rel="stylesheet" type="text/css" href="'.$value.'"/>';
        }

        else {
            $result = '';
        }
        return $result;
    }

    public function formatForm($type, $value) {
        if ($type === 'action') {
            if ($value === 'self') {
                return 'action="'. htmlspecialchars($_SERVER['PHP_SELF']) . '" ';
            }
            else {
                return 'action="'. htmlspecialchars($value) .'" ';
            }
        }
        if ($type === 'method') {
            if ($value === 'post') {
                return 'method="POST" ';
            }
            if ($value === 'get') {
                return 'method="GET" ';
            }
        }
    }

    public function formatButton ($type, $value) {
        if ($type === 'nav') {
            $result = 'onClick="window.location.href=\''. $value .'\'" ';
        }
        else if ($type === 'onclick') {
            $result = 'onClick="' .$value .'" ';
        }
        else if ($type === 'value') {
            $result = 'value="' .$value . '" ';
        }
        else {
            $result = '';
        }
        return $result;
    }
}

?>
