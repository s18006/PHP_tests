<?php
header ('Content-Type: text/html; charset="UTF-8"');
session_start();
$table_list = array('ID'=>'', 'ゲームタイム'=>'', '答えの合計'=>'', '正解'=>'', '不正解'=>'');

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/viewstyle.css">
    </head>

    <body>

<h1> ゲームオーバー </h1>
<h2> 結果 </h2>

<table border="1">
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
<input type="button" onclick="window.location.href='newgame.php'" value="新しゲームスタート"/>
    </body>

</html>
