<?php
namespace Pastebin;

class App {
  private $request;

  public function __construct(Request $request) {
    $this->request = $request;
  }

  public function action() {
    return $this->request->get('action');
  }
}
