<?php
header ('Content-Type: text/html; charset="UTF-8"');
session_start();
require_once 'controller.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/view_style.css">
    </head>
    <body>
<h1 class="game_over"> ゲームオーバー </h1>
<table>
    <tr>
        <th colspan="2"> ゲーム結果 </th>
    </tr>
<?php
foreach ($table_list as $key => $value) {
?>
    <tr>
        <td> <?php echo $key; ?> </td>
        <td> <?php echo $value; ?> </td>
    </tr>
<?php
}

?>
</table>

<table style="margin-top: 50px">
    <tr>
        <th style="min-width:60px;"> 問題のID </th>
        <th style="min-width: 250px;"> 問題　</th>
        <th style="min-width: 250px;"> ユーザーの答え </th>
        <th style="min-width: 80px;"> 正解　/ 不正解　</th>
    </tr>
    <?php
        for ($i = 0; $i < $user_answers_length; $i++) { ?>
    <tr>
        <td> <?php echo $i + 1; ?>  </td>
        <td> <?php echo $user_answers[$i][0]; ?> </td>
        <td> <?php echo $user_answers[$i][1]; ?> </td>
        <td> <?php if ($user_answers[$i][2] === '1') { echo '正解'; } else {echo '不正解'; } ?></td>
    </tr>
    <?php } ?>
</table>
<input type="button" onclick="window.location.href='newgame.php'" value="<?php if (count($_SESSION['repeat_game']) === 0) { echo '終了'; } else { echo 'QUIZを見直す'; }?>"/>
    </body>
</html>
