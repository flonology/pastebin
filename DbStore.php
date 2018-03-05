<?php
class DbStore {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function removeExpired($timestamp) {
    $query = 'DELETE FROM pastes WHERE expires <= :timestamp';

    return $this->pdo->exec($query, [
      ':timestamp' => $timestamp
    ]);
  }

  public function removePaste(Paste $paste) {
    $query = 'DELETE FROM pastes WHERE id = :id';

    return $this->pdo->exec($query, [
      ':id' => $paste->getId()
    ]);
  }

  public function savePaste(Paste $paste) {
    $query = '
      INSERT INTO pastes (
        id, name, content, password_hash, encryption_iv, retries_left, expires
      )
      VALUES(
        :id, :name, :content, :password_hash, :encryption_iv, :retries_left, :expires
      );
    ';

    return $this->pdo->exec($query, [
      ':id' => $paste->getId(),
      ':name' => $paste->getName(),
      ':content' => $paste->getText(),
      ':password_hash' => $paste->getPasswordHash(),
      ':encryption_iv' => $paste->getEncryptionIv(),
      ':retries_left' => $paste->getRetriesLeft(),
      ':expires' => $paste->getExpires()
    ]);
  }

  public function loadPaste($id) {
    $query = '
      SELECT id, name, content, password_hash, encryption_iv, retries_left, expires
      FROM pastes
      WHERE id = :id
    ';

    return $this->pdo->exec($query, [':id' => $id]);
  }

  public function loadPastes() {
    $query = '
      SELECT id, name, content, password_hash, encryption_iv, retries_left, expires
      FROM pastes
      ORDER BY id DESC
    ';

    return $this->pdo->exec($query);
  }
}
