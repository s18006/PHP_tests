<?php

require_once 'pageCreateClass.php';

class connectionClass extends pageCreateClass {
    //PDO connection
    public function connection() {
        try {
        $db = new PDO('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
        } catch (PDOException $e) {
            exit("データベースに接続できません。: {$e->getMessage()}");
        }
        return $db;
    }
}
?>
