<?php
require_once 'classes/isAuthenticatedClass.php';
$auth = new isAuthenticatedClass();

require_once 'classes/dbManagerClass.php';

class idListCreator extends dbManagerClass {
  private $query;
  private $idList = array();

  public function __construct($post) {
    $this -> query = (count($post) > 1) ? self::multyQuery($post) : "SELECT id FROM quiz4 WHERE quizId=?";
    self::createIdList($post);
  }

  public function multyQuery($post) {
    $extCont = count($post) - 1;
    $result = "SELECT id FROM quiz4 WHERE quizId=?";
    for ($i = 0; $i < $extCont; $i++) {
      $result .= " OR quizId=?";
    }
     return $result;
  }

  public function createIdList($post) {
    $param_list = str_repeat('i', count($_POST['title']));
    $this -> idList = self::downloadParam1Col($this -> query, $post, $param_list);
    shuffle($this -> idList);
  }

  public function getResult() {
    return $this -> idList;
  }
}

if (!isset($_POST['title']) && !isset($_SESSION['quizIds'])) {
   header('location: index.php');
}
else {
    if (isset($_POST['title'])) {
        $idListCreator = new idListCreator($_POST['title']);
        $_SESSION['quizIds'] = $idListCreator -> getResult();
        $_SESSION['idx'] = 0;
        unset($_POST['title']);
        header('location: '.$_SERVER['PHP_SELF']);
        exit;
    } else {
        $time = 1000;
        if (isset($_SESSION['quizIds'])) {
            $time = count($_SESSION['quizIds']) * 45;
        }
    }
}
?>
