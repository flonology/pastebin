<?php

class PasteRepository {
  public static function all(DbStore $store) {
    $pastes = [];
    $storedPastes = $store->loadPastes();

    foreach ($storedPastes as $paste) {
      $pastes[] = PasteHydrator::createFromDbEntry($paste);
    }

    return $pastes;
  }

  public static function find(DbStore $store, $id) {
    $paste = $store->loadPaste($id);
    if ($paste) {
      return PasteHydrator::createFromDbEntry($paste[0]);
    }

    return null;
  }
}
