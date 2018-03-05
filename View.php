<?php
class View {
  private static $entries = [];

  public static function add($key, $entry) {
    self::$entries[$key] = $entry;
  }

  public static function get($key) {
    return self::$entries[$key];
  }

  public static function enc($string) {
    return htmlentities($string);
  }

  public static function put($string) {
    echo self::enc($string);
  }  
}
