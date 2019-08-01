<?php

interface Manager {
    public function dbMethod($type, $query);
}


class dbManager implements Manager {
    //type can be: download, upload, delete
    public function dbMethod($type, $query) {
        $result = new $type($query);
        return $result -> getResult();
    }
}


abstract class connection {

    protected $db;
    protected $query;
    protected $idxList;

    //PDO connection
    public function __construct($query) {
        try {
            $this -> db = new PDO('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
        } catch (PDOException $e) {
            exit("データベースに接続できません。: {$e->getMessage()}");
        }
        $this -> query = $query['query'];
        $this -> idxList = $query['idxList'];
    }

    public abstract function prepareStat():object;
}

class download extends connection {

    private $type;
    private $result;

    public function __construct($query) {
        parent::__construct($query);
        $this -> type = $query['type'];
        $this -> {$this -> type}();
    }

    public function prepareStat():object {
        $stt = $this -> db -> prepare($this -> query);
        $stt->execute($this -> idxList);
        return $stt;
    }

    public function fetchWithColName():void {
        $stt = $this -> prepareStat();
        $this -> result = $stt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchWithoutColName():void {
        $stt = $this -> prepareStat();
        $this -> result = $stt -> fetchAll(PDO::FETCH_COLUMN);
    }

    public function getResult() {
        return $this -> result;
    }
}

class upload extends connection {

    public function __construct($query) {
        parent__construct();
    }

    public function prepareStat():object {
        return $this;
    }

}





?>
