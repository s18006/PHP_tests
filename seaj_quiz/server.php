<?php
require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$db = new dbManagerClass();
//変数の設定
$username = '';
$email = '';
$password = '';
$errors = '';
//login
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if (empty($username)) {
        $errors .= '<div class="error"> ユーザー名を記入して下さい</div>';
    }
    if (empty($password)) {
        $errors .= '<div class="error"> パスワードを記入して下さい</div>';
    }
    if (!empty($errors) == 0 ) {
        $password = hash('sha512', $password);
        $query_passwd = "SELECT COUNT(*) FROM users WHERE username=? and password=?";
        $result = $db -> downloadOneTitle($query_passwd, array($username, $password), 'ss');
        if ($result == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "ログインしました";
            header ('location: index.php');
        } else {
            $errors .= '<div class="error"> ユーザー名またパスワードが正しくありません</div>';
        }
    }
}
    //logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($username);
    header('location: login.php');
}
?>
