<?php

class isAuthenticatedClass {
    public function __construct() {
        $path = explode('/', htmlspecialchars($_SERVER['PHP_SELF']));
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['logout'])) {
            session_destroy();
            header('Location: '.$dirpath_login.'login.php');
        }
        if (end($path) != 'login.php') {
            if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
                $dirpath_login = self::setDirPath();
                return header('location:'.$dirpath_login.'login.php');
            }
        }
    }

    public function setDirPath() {
        //define the directory path
        $directory_path = dirname(htmlspecialchars($_SERVER['PHP_SELF']));
       //split and count numbers of directories
       $dirpath_folders = count(explode('/', $directory_path));
       //if you move the login file, you have to change the value of backup folders
       $backup_folders = $dirpath_folders - 3;
       $dirpath_login = '';
       for ($i = 0; $i < $backup_folders; $i++) {
            $dirpath_login .= '../';
       }
       return $dirpath_login;
    }
}
?>
