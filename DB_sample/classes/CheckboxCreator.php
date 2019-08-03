<?php

class CheckboxCreator {

    private $objects = array();
    private $resultAsString;
    private $resultAsArray = array();

    public function is_multidimensional(array $array):bool {
        return count($array) !== count($array, COUNT_RECURSIVE);
    }

    public function add(array $object):void {
        if (count($this -> objects) === 0) {
            $this -> objects = $object;
        } else {
            //if $object is a multidimensional array
            if ($this -> is_multidimensional($object)) {
                foreach ($object as $value) {
                    array_push($this -> objects, $value);
                }
            } else {
                array_push($this -> objects, $object);
            }
        }
    }

    public function createAsString():string {
        while ($value = current($this -> objects)) {
            $this -> resultAsString .= $this -> createElement(key($this -> objects), $value);
            next($this -> objects);
        }
        return $this -> resultAsString;
    }

    public function createAsArray(string $title = 'checkbox'):array {
        while ($value = current($this -> objects)) {
            array_push($this -> resultAsArray, array($title => $this -> createElement(key($this -> objects), $value)));
            next($this -> objects);
        }
        return $this -> resultAsArray;
    }

    //$elem includes name and value. Set id: name + $id
    public function createElement($id, $elem):string {
        $temp;
        //elem has two values: 1. name, 2. value
        if (count($elem) > 1) {
            $keys = array_keys($elem);
            $temp = '<input type="checkbox" id="'.$keys[0].$id.'" name="'.$keys[0].'[]" value="'.$elem[$keys[1]].'" onclick="show(this)"> <label for="'.$keys[0].$id.'" id="'.$keys[0].$id.'"> '.$elem[$keys[0]].'</label>';
        }
        //elem has only one value: name and value are same
        else {
            $keys = array_keys($elem);
            $temp = '<input type="checkbox" id="'.$keys[0].$id.'" name="'.$keys[0].'[]" value="'.$elem[$keys[0]].'" onclick="show(this)"> <label for="'.$keys[0].$id.'" id="'.$keys[0].$id.'"> '.$elem[$keys[0]].'</label>';
        }
        return $temp;
    }
}


?>
