<?php
use Pastebin\Request;

class PasteHydrator {
  public static function hydrate(Paste $paste, array $hydrate) {
    $paste
      ->setName($hydrate['paste_name'])
      ->setText($hydrate['paste_text'])
      ->setPasswordHashFromPlain($hydrate['password']);

    return true;
  }

  public static function createFromDbEntry(array $dbEntry) {
    $paste = new Paste($dbEntry['id']);
    $paste
      ->setName($dbEntry['name'])
      ->setText($dbEntry['content'])
      ->setPasswordHash($dbEntry['password_hash'])
      ->setRetriesLeft($dbEntry['retries_left'])
      ->setExpires($dbEntry['expires'])
      ->setEncryptionIv($dbEntry['encryption_iv']);

    return $paste;
  }

  public static function createNewFromRequest(Request $request) {
    $paste = new Paste();
    $paste->expiresInNumberOfDaysFrom(5, $request->time());

    self::hydrate($paste, $request->getPost());
    return $paste;
  }
}
