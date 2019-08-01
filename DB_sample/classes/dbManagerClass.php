<?php

interface Manager {
    public function dbMethod($query);
    public static function queryAnalyzer(string $query):string;
}


class dbManager implements Manager {

    //type can be: download, upload, delete
    public function dbMethod($query) {
        //query needs to inclue query and parameter element
        //change parameters to array
        if (!is_array($query['parameter'])) {
               $query['parameter'] = array($query['parameter']);
        }
        $queryType = self::queryAnalyzer($query['query']);
        $result = new $queryType($query);
        return $result -> getResult();
    }

    public static function queryAnalyzer(string $query):string {
        //define type of query
        $type;
        $queryLine = explode (' ', $query);
        switch(strtolower($queryLine[0])) {
            case 'select':
                $type = 'download';
                break;
            case 'delete':
                $type = 'delete';
                break;
            case 'insert':
            case 'update':
                $type = 'upload';
                break;
        }
        return $type;
    }
}

abstract class connection {

    protected $db;
    protected $query;
    protected $parameter;

    //PDO connection
    public function __construct($query) {
        try {
            $this -> db = new PDO('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
        } catch (PDOException $e) {
            exit("データベースに接続できません。: {$e->getMessage()}");
        }
        $this -> query = $query['query'];
        $this -> parameter = $query['parameter'];
    }

    public abstract function prepareStat();
}

class download extends connection {

    private $type = 'fetchWithColName';
    private $result;

    public function __construct($query) {
        parent::__construct($query);
        if (isset($query['type'])) {
            $this -> type = $query['type'];
        }
        $this -> {$this -> type}();
    }

    public function prepareStat():object {
        $stt = $this -> db -> prepare($this -> query);
        $stt->execute($this -> parameter);
        return $stt;
    }

    public function fetchWithColName():void {
        $stt = $this -> prepareStat();
        $this -> result = $stt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchWithoutColName():void {
        $stt = $this -> prepareStat();
        $this -> result = $stt -> fetchAll(PDO::FETCH_COLUMN);
    }

    public function getResult() {
        return $this -> result;
    }
}

abstract class oneway extends connection {

    protected $result;

    public function __construct($query) {
        parent::__construct($query);
    }

    public function prepareStat():void {
        $stt = $this -> db -> prepare($this -> query);
        $stt->execute($this -> parameter);
        $this -> result = true;
    }

    public abstract function getResult():string;
}

class upload extends oneway {

    public function __construct($query) {
        parent::__construct($query);
        $this -> prepareStat();
    }

    public function getResult():string {
        $result = ($this -> result === true) ? 'Upload was successful' : 'Upload was not successful';
        return $result;
    }
}

class delete extends oneway {

    public function __construct($query) {
        parent::__construct($query);
        $this -> prepareStat();
    }

    public function getResult():string {
        $result = ($this -> result === true) ? 'Object is deleted' : 'Object is not deleted';
        return $result;
    }
}
?>
