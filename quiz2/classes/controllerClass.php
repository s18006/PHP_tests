<?php
class controllerClass {
    public function __construct() {
        if(!isset($_SESSION)) {
            session_start();
        }
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader($className) {
        return require_once 'classes/'. $className . '.php';
    }

    public function addSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function getSession($key) {
        return $_SESSION[$key];
    }


}
?>
