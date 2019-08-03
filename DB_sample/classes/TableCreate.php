<?php

class tableCreator {

    private $name;
    private $tbody = array();

    public function __construct($name) {
        $this -> name = $name;
    }

    //add element to table body
    public function add(array $content):void {
        //when table content is empty
        if (count($this -> tbody) === 0) {
            $this -> tbody = $content;
        } //when table content is not empty
        else {
            if (count($this -> tbody) === count($content)) {
                for ($i = 0; $i < count($this -> body); $i++) {
                    $this -> tbody[$i] += $content[$i];
                }
            } else {
                '追加したい配列とテーブルコンテンツの長さは同じではありません';
            }
        }
    }

    public function create(tableBody $tableBody):string {
        $table = '';
        $collength = (count($this -> tbody) !== count($this -> tbody, COUNT_RECURSIVE)) ? count($this -> tbody[0]) : count($this -> tbody);
        $table .= '<table border="1" cellpadding="10"><tr><th colspan="'. $collength .'">' . $this -> name . '</th></tr>';
        $tableBody -> createContent($this -> tbody);
        $table .= $tableBody -> getResult();
        $table .= '</table>';
        return $table;
    }
}

class tableBody {

    private $tbody;
    private $content = '';
    private $multidimensional = true;

    public function createContent(array $tbody) {
        $this -> tbody = $tbody;
        $this -> is_multidimensional($tbody);
        $this -> createTBody();
    }

    public function is_multidimensional(array $array):void {
        $this -> multidimensional = (count($array) !== count($array, COUNT_RECURSIVE)) ? true : false;
    }

    public function createFirstRow():void {
        $temp = '<tr>';
        $row = ($this -> multidimensional) ? $this -> tbody[0] : $this -> tbody;
        if (is_array($row)) {
            while ($name = current($row)) {
                $temp .= '<th>' . key($row) . '</th>';
                next($row);
            }
        } else {
            $temp .= '<th>' . $row . '</th>';
        }
        $temp .= '</tr>';
        $this -> content .= $temp;
    }

    public function createTBody():void {
        $this -> createFirstRow();
        if ($this -> multidimensional) {
            while ($value = current($this -> tbody)) {
                $this -> rowCreator($value);
                next($this -> tbody);
            }
        } else {
            $this -> rowCreator($this -> tbody);
        }
    }

    public function rowCreator($row):void {
        $temp = "<tr>";
        if (is_array($row)) {
            while ($value = current($row)) {
                $temp .= "<td>" . $value . "</td>";
                next($row);
            }
        } else {
            $temp .= "<td>" . $row . "</td>";
        }
        $this -> content .= $temp;
    }

    public function getResult():string {
        return $this -> content;
    }
}
?>
