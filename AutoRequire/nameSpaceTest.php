<?php

function NSAutoload($class_name) {
  require_once str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
}

spl_autoload_register('NSAutoload');

use hivatkozasok as classes;

$test2 = new classes\autoCls_nS();
echo $test2->getTest(66);


?>
