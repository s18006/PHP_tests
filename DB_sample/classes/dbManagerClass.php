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

    //PDO connection
    public function __construct() {
        try {
            $this -> db = new PDO('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
        } catch (PDOException $e) {
            exit("データベースに接続できません。: {$e->getMessage()}");
        }
    }
}


class download extends connection {

    private $type;
    private $result;
    private $query;
    private $idxList;
    private $paramList = '';
    private $columnLen = 0;
    //if we fill columns with content
    private $columnTempContent = array();

    public function __construct($query) {
        parent::__construct();
        $this -> type = $query['type'];
        $this -> query = $query['query'];
        $this -> idxList = $query['idxList'];
        $this -> paramList = $query['paramList'];
        if (isset($query['columnLen'])) {
            $this -> columnLen = $query['columnLen'];
        }
        $this -> {$this -> type}();
    }

    public function prepareStat():object {
        $stt = $this -> db -> prepare($this -> query);
        if (strlen($this -> paramList) > 1) {
            //if query statement includes more than one parameter
            for ($i = 0; $i < strlen($this-> paramList); $i++) {
                $paramIdx = $i + 1;
                if ($this -> paramList[$i] === 'i') {
                    $stt->bindParam($paramIdx, $this -> idxList[$i], PDO::PARAM_INT);
                } else {
                    $stt->bindParam($paramIdx, $this -> idxList[$i], PDO::PARAM_STR);
                }
            }
        }
        if (strlen($this -> paramList) === 1) {
            if ($this -> paramList === 'i') {
                $stt->bindParam(1, $this -> idxList, PDO::PARAM_INT);
            } else {
                $stt->bindParam(1, $this -> idxList, PDO::PARAM_STR);
            }
        }
        $stt->execute();
        return $stt;
    }


    public function fillColumnContent($stt):object {
        for ($i = 0; $i < $this -> columnLen; $i++) {
            $param_idx = $i + 1;
            $stt-> bindColumn($param_idx, $this -> columnTempContent[$i]);
        }
        return $stt;
    }

    //query with *
    public function oneRowAll():void {
        $stt = $this -> prepareStat();
        $this -> result = $stt->fetch(PDO::FETCH_ASSOC);
    }

    public function allData():void {
        $prep_stt = $this -> prepareStat();
        $stt = $this -> fillColumnContent($prep_stt);
        $resultIdx = 0;
        $result = array();
        while($row = $stt->fetch()) {
            for ($k = 0; $k < $this -> columnLen; $k++) {
                $result[$resultIdx][$k] = $this -> columnTempContent[$k];
            }
            $resultIdx++;
        };
        $this -> result = $result;
    }

    public function getResult() {
        return $this -> result;
    }
}

?>
