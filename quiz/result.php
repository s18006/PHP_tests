<?php
header ('Content-Type: text/html; charset="UTF-8"');
session_start();
require_once 'modell.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/view_style.css">
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
<input type="button" onclick="window.location.href='newgame.php'" value="終了"/>
    </body>

</html>
