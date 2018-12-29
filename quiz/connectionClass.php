<?php

class connectionClass {
    public $dsn; //mysql, localhost, dbname test
    public $usr;
    public $password;
    //public $amountQuestions;

    //setting the PDO datas (db datas, username, password)
    public function setPDO_datas ($dsn, $usr, $password) {
        $this->dsn = $dsn;
        $this->usr = $usr;
        $this->password = $password;
    }

    //PDO connection
    public function connection() {
        try {
        $db = new PDO($this->dsn, $this->usr, $this->password);
        } catch (PDOException $e) {
            exit("データベースに接続できません。: {$e->getMessage()}");
        }
        return $db;
    }
}
?>
