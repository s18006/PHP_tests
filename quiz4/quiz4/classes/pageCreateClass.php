<?php
require_once 'createElementClass.php';

class pageCreateClass extends createElementClass {
    public $th_content = '';
    public $td_content = '';
    public $tbody_content = '';
    public $closeAroundTag = '';
    public $displayTag = '';
    public $insideValue = '';
    public $insideFormat = array();

    //headpart can include title, link_css, link_js
    public function pageStart ($headpart, $form) {
        $result = '';
        $result .= self::createNewHead($headpart);
        $result .= self::bodySet('open');
        if (is_array($form)) {
            if (!in_array('open', $form)) {
                $form[] = 'open';
            }
            $result .= self::formSet($form);
        }
        return $result;
    }

    public function formEnd() {
        $result = self::formSet('close');
        return $result;
    }

    public function pageEnd() {
        return self::bodySet('close');
    }

    //$headpart and $form same as pageStart, $tagname can include value, id, class, name
    public function pageStartwithTag($headpart, $form, $tag) {
        $result = self::pageStart($headpart, $form);
        $result .= self::formatFirstPart($tag);
        return $result;
    }

    public function createNewTag($tag) {
        $result = '';
        if (is_array($tag[0])) {
            foreach ($tag as $key) {
                $result .= self::formatFirstPart($key);
            }
        }
        else {
            $result = self::formatFirstPart($tag);
        }
        return $result;
    }

    public function createNewInputButton($tag) {
        $tag = self::tagfilter($tag);
        $result = self::fillInputButtonElement($tag);
        if (!empty($this -> closeAroundTag)) {
            $result = self::fillSimpleElement($result, '', $this -> closeAroundTag);
            $this -> closeAroundTag = '';
        }
        return $result;
    }

    public function createNewButton($tag) {
        $tag = self::tagfilter($tag);
        $result = self::fillButtonElement($tag);
        if (!empty($this -> closeAroundTag)) {
            $result = self::fillSimpleElement($result, '', $this -> closeAroundTag);
            $this -> closeAroundTag = '';
        }
        return $result;
    }

    public function createNewIRadio ($tag) {
        $tag = self::tagFilter($tag);
        $tagname = 'radio';
        $result = self::fillIRadioCheckboxElement($this->displayTag, $tag, $tagname);
        $this -> displayTag = '';
        if (!empty($this -> closeAroundTag)) {
            $result = self::fillSimpleElement($result, '', $this -> closeAroundTag);
            $this -> closeAroundTag = '';
        }
        return $result;
    }

    public function createNewCheckbox ($tag) {
        $tag = self::tagFilter($tag);
        $tagname = 'checkbox';
        $result = self::fillIRadioCheckboxElement($this->displayTag, $tag, $tagname);
        $this -> displayTag = '';
        if (!empty($this -> closeAroundTag)) {
            $result = self::fillSimpleElement($result, '', $this -> closeAroundTag);
            $this -> closeAroundTag = '';
        }
        return $result;
    }

    public function formatFirstPart($tag) {
        $tagList = array('type=img', 'type=div', 'type=p', 'type=span', 'type=h1', 'type=h2','type=h3', 'type=h4', 'type=textarea', 'type=header', 'type=tr', 'type=a');
        $inputList = array('type=input-text', 'type=input-date', 'type=input-number', 'type=input-hidden', 'type=input-password', 'type=input-tel', 'type=input-email', 'type=input-datetime-local', 'type=input-submit');
        $tag = self::tagFilter($tag);
        foreach ($tag as $key => $value) {
            if (in_array($value, $tagList) || in_array($value, $inputList)) {
                $tagname = substr($value, 5);
                unset($tag[$key]);
            }
            if (explode('=', $value)[0] === 'value') {
                $input = substr($value, 6);
                unset($tag[$key]);
            }
            if (explode('=', $value)[0] === 'text') {
                $preText = substr($value, 5);
                unset($tag[$key]);;
            }
        }
        //define tag
        if (in_array('type='.$tagname, $tagList)) {
            $input = self::fillSimpleElement($input, $tag, $tagname);
        }
        if (in_array('type='.$tagname, $inputList)) {
            $input = self::fillInputElement($input, $tag, $tagname);
        }
        //if there is pre text inside of tag
        if (isset($preText)) {
            $input = self::fillSimpleElement($preText, '', 'span') . $input;
        }
        //if there is an inside part close around with this and set value and style
        if (!empty($this->closeAroundTag)) {
            $input = self::fillSimpleElement($this->insideValue.$input, $this->insideFormat, $this -> closeAroundTag);
            $this -> closeAroundTag = '';
            $this -> insideValue = '';
            $this -> insideFormat = array();
        }
        return $input;
    }

    public function createNewSelect($tag) {
        foreach ($tag[0] as $key => $value) {
            if ($value === 'type=select') {
                unset($tag[0][$key]);
            }
        }
        $tag[0] = array_values($tag[0]);
        return self::createSelect($tag[0], $tag[1]);
    }

    public function createNewTable($tag) {
        if (is_array($tag[0]) && count($tag) >= 1) {
            if (in_array('type=th', $tag[0])) {
                $this -> th_content = self::formatTablePart($tag);
                return $this -> th_content;
            }
            if (in_array('type=td', $tag[0])) {
                $this -> td_content .= self::formatTablePart($tag);
            }
        }
        if (!is_array($tag[0])) {
            if (in_array('type=tbody', $tag)) {
                $this -> tbody_content = self::formatTableStructure($tag);
            }

            if (in_array('type=table', $tag)) {
                return self::formatTableStructure($tag);
            }
        }
    }

    //if there is any inside or display part...
    public function tagFilter($tag) {
        $insideList = array('inside-class', 'inside-id', 'inside-name');
        foreach ($tag as $key => $value) {
            if (explode('=', $value)[0] === 'inside')  {
                $this -> closeAroundTag = substr($value, 7);
                unset($tag[$key]);
            }
            if (substr($value, 0, 12) == 'inside-value') {
                $this -> insideValue = substr($value, 13);
                unset($tag[$key]);
            }
            if (in_array(explode('=', $value)[0], $insideList)) {
                $this->insideFormat[] = explode('-', $value, 2)[1];
                unset($tag[$key]);
            }
            if (explode('=', $value)[0] === 'display') {
                $this -> displayTag = substr($value, 8);
                unset($tag[$key]);
            }
        }
        $tag = array_values($tag);
        return $tag;
    }
}
?>
