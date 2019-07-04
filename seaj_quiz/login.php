<?php
require_once 'server.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> ログイン </title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="css/login.css"/>
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <div class="header">
                <h2> SEA-J QUIZ </h1>
                <h3> ログイン </h2>
            </div>
            <div class="login-container">
                <?php echo $errors; ?>
                <div class="input-group">
                    <img src="images/user-circle-solid.svg">
                    <input type="text" name="username" value="<?php echo $username; ?>" placeholder="ユーザー名"/>
                </div>
                <div class="input-group">
                    <img src="images/key-solid.svg">
                    <input type="password" name="password" placeholder="パスワード"/>
                </div>
                <div class="input-group_submit">
                    <button class="btn" type="submit" name="login"> ログイン </button>
                </div>
            </div>

        </form>
    </body>
</html>
