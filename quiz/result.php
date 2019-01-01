<?php
header ('Content-Type: text/html; charset="UTF-8"');
session_start();
include_once ('quizResultClass.php');
$test = new quizResultClass();
$test -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
$table_data = $test->downloadResult();
$table_list = array('ID'=>1, 'ゲームタイム'=>$table_data[0]. '秒', '答えの合計'=>$table_data[1], '正解'=>$table_data[2], '不正解'=>$table_data[3]);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/viewstyle.css">
    </head>

    <body>

<h1> ゲームオーバー </h1>

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
<input type="button" onclick="window.location.href='newgame.php'" value="EXIT"/>
    </body>

</html>
