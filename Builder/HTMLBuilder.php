<?php

require_once 'Builder.php';

class HTMLBuilder extends Builder {
    
    private $filename;
    private $writer;

    public function makeTitle($title) {
        $this -> filename = $title .".html";
        if (file_exists($this -> filename)) {
            $time = date("YmdHms");
            $this -> filename = $title . $time .".html";
        }
        $this -> writer = fopen($this -> filename, "a") or die("Unable to open file!");
        fwrite($this -> writer, "<html>\n<head>\n<meta charset='UTF-8'/>\n<title>" . $title ."</title>\n</head>\n<body>");
        fwrite($this -> writer, "<h1>" . $title . "</h1>\n");
    }

    public function makeString($str) {
        fwrite($this -> writer, "<p>" . $str . "</p>\n");
    }

    public function makeItems($items) {
        fwrite($this -> writer, "<ul>\n");
        if (is_array($items)) {
            for ($i = 0; $i < count($items); $i++) {
                fwrite($this -> writer, "<li>" . $items[$i] . "</li>\n");
            }
        } else {
            fwrite($this -> writer, "<li>" . $items . "</li>\n");
        }
        fwrite($this -> writer, "</ul>\n");
    }

    public function close() {
        fwrite($this -> writer, "</body>\n</html>\n");
        fclose($this -> writer);
    }

    public function getResult() {
        return $this -> filename;
    }
}

?>
