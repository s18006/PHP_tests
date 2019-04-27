<?php

require_once 'classes/controllerClass.php';
$conn = new controllerClass();
$db = new dbManagerClass();
$create = new pageCreateClass();
if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
    $keyword = '%'.$_POST['keyword'].'%';

    $query_keyList = "SELECT question FROM quiz4 where question like ?";
    $keyList = $db -> downloadParams($query_keyList, $keyword, 's', 1);
    $create -> createNewTable(array(array('type=th', 'value=もうアップロードされた問題')));
    foreach ($keyList as $key => $value) {
        $create -> createNewTable(array(array('type=td', 'value='.$value[0])));
    }

    $result = $create -> createNewTable(array('type=table'));
    echo $result;
}
?>
