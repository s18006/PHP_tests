<?php
$db = new dbManagerClass();

//valtozok alapertekeinek beallitasa, hibauzenet lista
$username = '';
$email = '';
$password = '';
$errors = '';

//login
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if (empty($username)) {
        $errors .= $create -> createNewTag(array('type=div', 'class=error', 'value=ユーザー名を記入して下さい'));
    }
    if (empty($password)) {
        $errors .= $create -> createNewTag(array('type=div', 'class=error', 'value=パスワードを記入して下さい'));
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
            $errors .= $create -> createNewTag(array('type=div', 'class=error', 'value=ユーザー名またパスワードが正しくありません'));
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
