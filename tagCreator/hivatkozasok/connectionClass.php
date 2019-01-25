<?php
class connectionClass {
    //PDO connection
    public function connection() {
        try {
            $db = new PDO('mysql:dbname=test;host=localhost;charset=utf8', 'testuser', '0808');
        } catch (PDOException $e) {
            exit("Nem sikerült csatlakozni: {$e->getMessage()}");
        }
        return $db;
    }
}
?>
