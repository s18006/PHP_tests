<!DOCTYPE html>
<html>
    <head>
        <script>
            const show = (obj) => {
                alert("パスワードは" + obj.value + "です。");
            }
        </script>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="css/Test.css"/>
    </head>
    <body>

<?php

require_once 'classes/dbManagerClass.php';
require_once 'classes/TableCreate.php';
require_once 'classes/CheckboxCreator.php';
$db = new dbManager;

$query = array('type' => 'fetchWithColName',
               'query' => "SELECT id as ID, username as ユーザー名, email as メールアドレス FROM users",
               'parameter' => '',
                );
$items = $db -> dbMethod($query);
/* first step */
//print_r($items);


/* second step: create simple table element */
$table = new tableCreator('ユーザー');
$table -> add($items);


$query = array('type' => 'fetchWithColName',
               'query' => "SELECT t.click, u.password from users u, (SELECT 'パスワードを表示して' click from dual) t",
               'parameter' => "",
            );
$rb_cont = $db -> dbMethod($query);

$rb = new RadioButtonCreator;
$rb -> add($rb_cont);
//$rbElem = $rb -> createAsString();
/*third step: create simple radio button elements */
//echo $rbElem;

/*forth step: add radio button elements to table content */
$items2 = $rb -> createAsArray('パスワードの表示');
$table -> add($items2);
echo $table -> create(new tableBody());

?>
    </body>
</html>
