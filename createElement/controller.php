<?php
require_once 'createElementClass.php';

$test = new createElementClass();

$newdiv = $test ->createNewElement('<div> のタグのテスト', 'div', 'test');
$newh1 = $test->createNewElement('<h1>のタグのテスト', 'h1', 'h1');

$h2_content = array('一番目' => 'h2_1', '二番目' => 'h2_2', '三番目' => 'h2_1');

foreach ($h2_content as $key => $value) {
    $newh2[] = $test->createNewElement($key, 'h2', $value);
}
echo $newh1;

foreach ($newh2 as $key) {
        echo $key;
}
echo $newdiv;

?>
