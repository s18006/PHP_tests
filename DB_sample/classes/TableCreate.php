<?php

class tableTitle {

    private $title;
    //$title is array or string
    public function __construct($title) {
       $this -> title = $title;
    }

    public function makeTitle() {
        $temp = '<tr>';
        if (is_array($this -> title)) {
            while ($name = current($this -> title)) {
                $temp .= '<th>' . key($this-> title) . '</th>';
                next($this -> title);
            }
        } else {
            $temp .= '<th>' . $this -> title . '</th>';
        }
        $temp .= '</tr>';
        return $temp;
    }
}

class tableBody {

    private static $tbody;

    public function is_multidimensional(array $array):bool {
        return count($array) !== count($array, COUNT_RECURSIVE);
    }

    public function addTableBody(array $tbody):void {
        if ($this -> is_multidimensional($tbody)) {
            while ($value = current($tbody)) {
                $this -> rowCreator($value);
                next($tbody);
            }
        } else {
            $this -> rowCreator($tbody);
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
        self::$tbody .= $temp;
    }

    public function createTable($title):string {
        $table = "<table border=\"1\" cellpadding=\"10\">";
        $table .= $title -> makeTitle();
        $table .= self::$tbody;
        $table .= "</table>";
        self::$tbody ='';
        return $table;
    }
}
?>
