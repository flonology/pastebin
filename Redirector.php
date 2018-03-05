<?php
namespace Pastebin;

class Redirector {
  public static function redirectTo($actionName, $pid = '') {
    $location = UrlBuilder::url($actionName, $pid);

    header('Location: ' . $location);    
    exit();
  }
}
