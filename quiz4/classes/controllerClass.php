<?php

require_once 'isAuthenticatedClass.php';

class controllerClass extends isAuthenticatedClass {
    public function __construct() {
        parent::__construct();
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
