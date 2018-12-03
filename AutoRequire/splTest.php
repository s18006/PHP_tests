<?php

function myAutoload($class_name) {
  require_once 'hivatkozasok/'.$class_name . '.php';
}

spl_autoload_register('myAutoload');

$test = new autoCls();
echo $test->getTest(55)."\n";


?>
