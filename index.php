<?php
include_once 'bootstrap.php';
use Pastebin\App;
use Pastebin\Request;
use Pastebin\Encryptor;
use Pastebin\Redirector;

Request::ensureHttps($_SERVER);
$request = Request::fromGlobals();

$app = new App($request);
$pdo = new PdoSqlite('db/pastebin.sq3');
$db = new DbStore($pdo);

switch ($app->action()) {
  case 'password':
    View::add('pid', $request->get('pid'));
    break;

  case 'show':
    $pid = $request->get('pid');

    $password = $request->post('password');
    if ($password == '') {
      Redirector::redirectTo('password', $pid);
    }

    $paste = PasteRepository::find($db, $pid);
    if ($paste === null) {
      Redirector::redirectTo('list');
    }

    $passwordOk = password_verify($password, $paste->getPasswordHash());
    $encryptor = new Encryptor($password);
    $paste->decryptWith($encryptor);

    View::add('paste', $paste);
    View::add('password_ok', $passwordOk);

    if ($passwordOk) {
      $db->removePaste($paste);
    }

    break;

  case 'list':
    $db->removeExpired($request->time());
    View::add('paste_list', PasteRepository::all($db));
    break;

  case 'create_paste':
    $password = $request->post('password');
    if ($password == '') {
      Redirector::redirectTo('add', $pid);
    }

    $encryptor = new Encryptor($password);
    $paste = PasteHydrator::createNewFromRequest($request)->encryptWith($encryptor);

    $db->savePaste($paste);
    Redirector::redirectTo('list');

  default:
    $paste = new Paste();

    View::add('paste_name', $paste->getName());
    break;
}

include 'views/index.html.php';
