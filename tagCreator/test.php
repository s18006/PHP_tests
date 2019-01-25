<?php
header ('Content-type: text/html; charset=utf8');
?>
<link rel="stylesheet" type="text/css" href="test.css">
<?php
function myAutoload($class_name) {
  require_once 'hivatkozasok/' . $class_name . '.php';
}
spl_autoload_register('myAutoload');

$test = new createElementClass();

echo $test -> createNewElement('newTest', 'p', 'class=id');

echo $test -> createNewElement('ok', 'h1', 'class=h1');

$th_tags = $test -> createNewElement(
    $test->createNewElement(array('test1', 'test2', 'test3'), 'th', array('class=th_row', 'req=disabled')), 'tr', 'class=th_row');

$td_tags = $test->createNewElement(
   $test->createNewElement(
        array('test4', 'test5', 'test6'), 'td', array(array('class=td1'), array('class=td2'), array('class=td3'))
   ), 'tr', ''
);
echo $test ->createNewElement(array($th_tags, $td_tags), 'table', 'id=table');

$select_content = $test -> createNewElement(
        array('Search'=>array('value=search', 'id=search'), 'Find'=>array('value=find', 'id=find')), 'select', array('db=find', 'name=test_select[]')
);

echo $test -> createNewElement($select_content, 'p', '');
echo $test -> createNewElement(array('Move', "window.location.href='test2.php'"), 'button', 'class=btn');

echo $test -> createNewElement(':)', 'input-text', 'req=disabled');
?>
