<?php

class queryCreator {
    private $result;

    public function __construct($post) {
        $this -> result = (count($post) > 1) ? self::multyQuery($post) : "SELECT id FROM quiz4 WHERE quizId=?";
    }

    public function multyQuery($post) {
        $extCont = count($post) - 1;
        $result = "SELECT id FROM quiz4 WHERE quizId=?";
        for ($i = 0; $i < $extCont; $i++) {
            $result .= " OR quizId=?";
        }
        return $result;
    }

    public function getResult() {
        return $this -> result;
    }
}


$query = new queryCreator($_POST['title']);
$query_ids = $query -> getResult();
require_once '../quiz4/classes/dbManagerClass.php';
$db = new dbManagerClass();

$param_list = str_repeat('i', count($_POST['title']));
$result = $db -> downloadParam1Col($query_ids, $_POST['title'], $param_list);
shuffle($result);
print_r($result);

?>
