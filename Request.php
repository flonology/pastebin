<?php
namespace Pastebin;

class Request {
  private $get;
  private $post;
  private $time;

  public static function fromGlobals() {
    return new self($_GET, $_POST, time());
  }

  public static function ensureHttps($server) {
    if ($server['SERVER_SOFTWARE'] === 'PHP 7.1.1 Development Server') {
      return true;
    }

    if (isset($server['HTTPS']) && $server['HTTPS'] === 'on') {
      return true;
    }

    exit('Please use https.');
  }

  public function __construct($get, $post, $time) {
    $this->get = $get;
    $this->post = $post;
    $this->time = $time;
  }

  public function get($key) {
    if (isset($this->get[$key]) == false) {
      return null;
    }

    return $this->get[$key];
  }

  public function post($key) {
    if (isset($this->post[$key]) == false) {
      return null;
    }

    return $this->post[$key];
  }

  public function getPost() {
    return $this->post;
  }

  public function isPost() {
    return !empty($this->post);
  }

  public function time() {
    return $this->time;
  }
}
