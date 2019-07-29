<?php

abstract class Item {
    protected $caption;

    public function __construct(string $caption) {
        $this -> caption = $caption;
    }
    public abstract function makeHTML():string;
}

abstract class Link extends Item {
    protected $url;

    public function Link(string $caption, string $url) {
        //instace caption in Item abstract class
        parent::__construct($caption);
        //instace url here
        $this -> url = $url;
    }
}

abstract class Tray extends Item {
    protected $tray = array();

    public function __construct(string $caption) {
        //instance caption in Item abstract class
        parent::__construct($caption);
    }

    public function add($item):void {
        //!!add item(object) to tray and the call the makeHTML method
        array_push($this -> tray, $item);
    }
}

abstract class Page {
    protected $title;
    protected $author;
    protected $content = array();

    public function __construct(string $title, string $author) {
        $this -> title = $title;
        $this -> author = $author;
    }

    public function add($item):void {
        //!!add item(object) to content and the call the makeHTML method
        array_push($this -> content, $item);
    }

    public function output() {
        try {
            $filename = $this -> title . ".html";
            if (file_exists($filename)) {
                $time = date("YmdHms");
                $filename = $this -> title . $time .".html";
            }
            $writer = fopen($filename, "w") or die("Unable to open file!");
            fwrite($writer, $this -> makeHTML());
            fclose($writer);
        } catch (Exception $e) {
            echo "ファイルを作成できませんでした。", $e->getMessage(), "\n";
        }
    }

    public abstract function makeHTML():string;
}

abstract class Factory {
    public static function getFactory($classname) {
        $factory = null;

        try {
            $factory = new $classname();
        } catch (Exception $e) {
            echo "インスタンスは失敗しました：", $e -> getMessage(), "\n";
        }

        return $factory;
    }

    public abstract function createLink(string $caption, string $url);
    public abstract function createTray(string $caption);
    public abstract function createPage(string $title, string $author);
}


class ListLink extends Link {
    public function __construct(string $caption, string $url) {
        parent::Link($caption, $url);
    }

    public function makeHTML():string {
        return "<li><a href=\"" . $this -> url . "\">" . $this -> caption . "</a></li>\n";
    }
}

class ListTray extends Tray {
    public function __construct(string $caption) {
        //instance caption in Item abstract class
        parent::__construct($caption);
    }

    public function makeHTML():string {
        $buffer = "";
        $buffer .= "<li>\n";
        $buffer .= $this -> caption ."\n";
        $buffer .= "<ul>\n";
        $it = new ItemIterator($this -> tray);
        while($it -> hasNext()) {
            //call link class makeHTML() method
            $buffer .= $it -> next() -> makeHTML();
        }
        $buffer .= "</ul>\n";
        $buffer .= "</li>\n";
        return $buffer;
    }
}

class ListPage extends Page {

    public function __construct(string $title, string $author) {
        parent::__construct($title, $author);
    }

    //add method in Page Class

    public function makeHTML():string {
        $buffer = "";
        $buffer .= "<html>\n<head>\n<meta charset=\"UTF-8\"/>\n<title>" . $this -> title . "</title>\n</head>";
        $buffer .= "<body>\n";
        $buffer .= "<h1>" . $this -> title . "</h1>";
        $buffer .= "<ul>\n";
        $it = new ItemIterator($this -> content);
        while($it -> hasNext()) {
            //call tray class makeHTML() method
            $buffer .= $it -> next() -> makeHTML();
        }
        $buffer .= "</ul>\n";
        $buffer .= "<hr><address>" . $this -> author . "</address></hr>\n";
        $buffer .= "</body>\n</html>";
        return $buffer;
    }
}

class ListFactory extends Factory {
    public function createLink(string $caption, string $url):object {
        //return an object
        return new ListLink($caption, $url);
    }

    public function createTray($caption):object {
        //return an object
        return new ListTray($caption);
    }

    public function createPage($title, $author):object {
        //return an object
        return new ListPage($title, $author);
    }
}

class TableLink extends Link {
    public function __construct(string $caption, string $url) {
        parent::__construct($caption, $url);
    }

    public function makeHTML():string {
        return "<td><a href=\">" . $this -> url . "\">"  . $this -> caption . "</a></td>\n";
    }
}

class TableTray extends Tray {
    public function __construct(string $caption) {
        //instance caption in Item abstract class
        parent::__construct($caption);
    }

    public function makeHTML():string {
        $buffer = "";
        $buffer .= "<td>\n";
        $buffer .= "<table width=\"100%\" border=\"1\"><tr>";
        $buffer .="<td bgcolor=\"#cccccc\" align=\"center\" colspan=\"". count($this -> tray) ."\"><b>" . $this -> caption ."</b></td>\n";
        $buffer .= "</tr>\n";
        $buffer .= "<tr>\n";
        $it = new ItemIterator($this -> tray);
        while($it -> hasNext()) {
            $buffer .= $it -> next() -> makeHTML();
        }
        $buffer .= "</tr>\n";
        $buffer .= "</table>\n";
        return $buffer;
    }
}

class TablePage extends Page {

    public function __construct(string $title, string $author) {
        parent::__construct($title, $author);
    }

    //add method in Page Class

    public function makeHTML():string {
        $buffer = "";
        $buffer .= "<html>\n<head>\n<meta charset=\"UTF-8\"/>\n<title>" . $this -> title . "</title>\n</head>";
        $buffer .= "<body>\n";
        $buffer .= "<h1>" . $this -> title . "</h1>";
        $buffer .= "<table width=\"80%\" border=\"3\">\n";
        $it = new ItemIterator($this -> content);
        while($it -> hasNext()) {
            //call tray class makeHTML() method
            $buffer .= "<tr>" . $it -> next() -> makeHTML() . "</tr>";
        }
        $buffer .= "</table>\n";
        $buffer .= "<hr><address>" . $this -> author . "</address></hr>\n";
        $buffer .= "</body>\n</html>";
        return $buffer;
    }
}

class TableFactory extends Factory {
    public function createLink(string $caption, string $url):object {
        //return an object
        return new TableLink($caption, $url);
    }

    public function createTray($caption):object {
        //return an object
        return new TableTray($caption);
    }

    public function createPage($title, $author):object {
        //return an object
        return new TablePage($title, $author);
    }
}

class ItemIterator {

    private $shelf;
    private $index;

    public function __construct($shelf) {
        $this -> shelf = $shelf;
        $this -> index = 0;
    }

    public function hasNext():bool {
        if ($this -> index < count($this -> shelf)) {
            return true;
        } else {
            return false;
        }
    }

    public function next() {
        $item = $this -> shelf[$this -> index];
        $this -> index++;
        return $item;
    }
}

class Main {
    public function __construct($input) {
        if ($input !== 'TableFactory' && $input !== 'ListFactory') {
            echo 'Usage: php7.2 Main.php <and name of Concrete Factory>' . PHP_EOL;
            echo 'Example 1: php7.2 Main.php ListFactory' . PHP_EOL;
            echo 'Example 2: php7.2 Main.php TableFactory' . PHP_EOL;
        } else {
            $factory = Factory::getFactory($input);
            $asahi = $factory -> createLink("朝日新聞", "http://www.asahi.com/");
            $yomiuri = $factory -> createLink("読売新聞", "http://yomiuri.co.jp");
            $us_yahoo = $factory -> createLink("Yahoo!", "http://www.yahoo.com");
            $jp_yahoo = $factory -> createLink("Yahoo!Japan", "http://www.yahoo.co.jp");
            $excite = $factory -> createLink("Excite", "http://www.excite.com");
            $google = $factory -> createLink("Google", "http://www.google.com");

            $traynews = $factory -> createTray("新聞");
            $traynews -> add($asahi);
            $traynews -> add($yomiuri);

            $trayyahoo = $factory -> createTray("Yahoo!");
            $trayyahoo -> add($us_yahoo);
            $trayyahoo -> add($jp_yahoo);

            $traysearch = $factory -> createTray("サーチエンジン");
            $traysearch -> add($trayyahoo);
            $traysearch -> add($excite);
            $traysearch -> add($google);

            $page = $factory -> createPage("LinkPage", "結城　浩");
            $page -> add($traynews);
            $page -> add($traysearch);
            $page -> output();
        }
    }
}


$input;
if (!isset($argv[1])) {
    $input = '0';
} else {
    $input = $argv[1];
}
$main = new Main($input);
?>
