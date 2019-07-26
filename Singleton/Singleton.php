<?php

class Singleton {

  private static $singleton;

  private function __construct() {
    echo 'インスタンスを作成しました。' . PHP_EOL;
  }

  public static function getInstance() {
    if (is_null( self::$singleton )) {
      self::$singleton = new self();
    }
    return self::$singleton;
  }
}
?>
