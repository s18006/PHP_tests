<?php

abstract class connectionClass {

    protected $db;

    //PDO connection
    public function __construct() {
        try {
            $this -> db = new PDO('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
        } catch (PDOException $e) {
            exit("データベースに接続できません。: {$e->getMessage()}");
        }
    }

    public abstract function dbMethod($type, $query);
}
?>
