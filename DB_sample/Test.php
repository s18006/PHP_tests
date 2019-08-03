
<script>
const show = (obj) => {
    alert("password is \n" + obj.value);
}
</script>

<?php

require_once 'classes/dbManagerClass.php';
require_once 'classes/TableCreate.php';
require_once 'classes/CheckboxCreator.php';
$db = new dbManager;

$query = array('type' => 'fetchWithColName',
                'query' => "SELECT id FROM users",
                'parameter' => '',
                );
$items = $db -> dbMethod($query);

$query = array('type' => 'fetchWithColName',
                'query' => "SELECT username, password FROM users",
                'parameter' => "",
            );
$cbx_cont = $db -> dbMethod($query);
$cbx = new CheckboxCreator;
$cbx -> add($cbx_cont);
$items2 = $cbx -> createAsArray('password check');

$table = new tableCreator('Users');
$table -> add($items);
$table -> add($items2);
echo $table -> create(new tableBody());

?>
