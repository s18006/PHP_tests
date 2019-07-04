<?php

require_once 'isAuthenticatedClass.php';
$auth = new isAuthenticatedClass();

require_once 'dbManagerClass.php';

class startContent extends dbManagerClass {
    private $staticCont = array( 1 => '情報セキュリティマネジメント', 2 => 'セキュリティ運用', 3 => 'インフラセキュリティ', 4 => '不正アクセス', 5 => 'ファイアウォール', 6 => '侵入検知', 7 => 'アプリケーションセキュリティ', 8 => 'OSセキュリティ', 9 => '認証', 10 => 'プログラミング', 11 => '不正プログラム', 12 => '暗号', 13 => '電子署名', 14 => 'PKI', 15 => 'セキュリティプロトコル', 16 => '法令・規格');
    private $statusList = array();
    private $content;

    public function __construct() {
        self::deleteFormerCont();
        self::statusList();
        self::createContent();
    }

    public function deleteFormerCont() {
        $query = "DELETE FROM quiz_result WHERE user_id=?";
        self::deletePlease($query, self::getSession('username'), 's');
    }

    public function statusList() {
        $query = "SELECT quizId, count(*), validity from quiz4 WHERE quizId <= 16 GROUP BY quizId ORDER BY quizId";
        $temp_list = self::downloadParams($query, '', '', 3);
        //if some quizId is missing in middle of db table
        foreach ($temp_list as $key => $value) {
            $this -> statusList[$value[0]] = $value;
        }
    }

    public function createContent() {
        foreach ($this -> staticCont as $key => $value) {
            //if db content exists ...
            if (isset($this -> statusList[$key])) {
                $disabled_status = ($this -> statusList[$key][2]) == 'valid' ? '' : 'disabled';
                //create enabled or disabled checkbox element
                $this -> content .= '<div class="container-toggle'.$key.'"><input id="toggle'.$key.'" value="'.$key.'" type="checkbox" name="title[]" '.$disabled_status.' onclick="display(this)"><label for="toggle'.$key.'">'.$value.'('.$this ->statusList[$key][1].')</label><input type="hidden" id="toggle'.$key.'-len" value="'.$this -> statusList[$key][1].'"></div>';
            }
            //if db content does not exist
            if (!isset($this -> statusList[$key])) {
                $this -> content .= '<div class="container-toggle'.$key.'"><input id="toggle'.$key.'" value="'.$key.'" type="checkbox" name="title[]" disabled onclick="display(this)"><label for="toggle'.$key.'">'.$value.'(0)</label></div>';
            }
        }
    }

    public function getSession($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return 'notFound';
        }
    }

    public function getContent() {
        return $this -> content;
    }
}

$startContent = new startContent();
$checkboxElem = $startContent -> getContent();

?>
