<?php

class HtmlWriter {

    private $writer;
    
    public function __construct($writer) {
        $this -> writer = $writer;
    }

    public function title(string $title):void {
        fwrite($this -> writer, "<html>\n");
        fwrite($this -> writer, "<head>\n");
        fwrite($this -> writer, "<title>" . $title . "</title>\n");
        fwrite($this -> writer, "</head>\n");
        fwrite($this -> writer, "<body>\n");
        fwrite($this -> writer, "<h1>" . $title . "</h1>\n");
    }

    public function paragraph(string $msg):void {
        fwrite($this -> writer, "<p>" . $msg . "</p>");
    }

    public function link(string $href, string $caption):void {
        $content = '<a href="'. $href . '">' . $caption . '</a>';
        $this -> paragraph($content);
    }

    public function mailto(string $mailaddress, string $username):void {
        $content = 'mailto: ' . $mailaddress;
        $this -> link($content, $username);
    }

    public function close():void {
        fwrite($this -> writer, "</body>\n");
        fwrite($this -> writer, "</html>\n");
        fclose($this -> writer);
    }
}

?>
