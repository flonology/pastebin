<?php
namespace Pastebin;

class UrlBuilder {
  public static function url($actionName, $pid = '') {
    $location = 'index.php?action=' . $actionName;
    if ($pid) {
      $location .= '&pid=' . $pid;
    }

    $location .= '&u=' . uniqid();
    return $location;
  }
}
