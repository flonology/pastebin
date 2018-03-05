<?php
use Pastebin\Encryptor;

class Paste {
  private $id;
  private $name;
  private $text;
  private $passwordHash;
  private $retriesLeft;
  private $expires;

  public function __construct($id = null) {
    $names = [
      'cat', 'dog', 'house', 'computer', 'spoon', 'sun', 'rain', 'car', 'bike',
      'garden', 'flower', 'butter', 'pizza', 'milk', 'book', 'paper', 'wood'
    ];

    $this->id = $id ?: str_replace('.', '', uniqid('P', true));
    $this->retriesLeft = 3;
    $this->name = $names[array_rand($names)];
    $this->text = '';
    $this->passwordHash = '';
    $this->encryptionIv = '';
  }

  public function encryptWith(Encryptor $encryptor) {
    $this->setEncryptionIv(base64_encode($encryptor->getIv()));
    $this->setText($encryptor->encrypt($this->getText()));
    return $this;
  }

  public function decryptWith(Encryptor $encryptor) {
    $encryptor->setIv(base64_decode($this->getEncryptionIv()));
    $this->setText($encryptor->decrypt($this->getText()));
    return $this;
  }

  public function setPasswordHashFromPlain($password) {
    $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    return $this;
  }

  public function expiresInNumberOfDaysFrom($numDays, $startTimeStamp) {
    $this->expires = $numDays * 24 * 60 * 60 + $startTimeStamp;
    return $this;
  }

  public function hasBeenExpired($now) {
    if ($now >= $this->expires) {
      return true;
    }

    return false;
  }

  /**
   * Getter and Setter below
   */

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getText() {
    return $this->text;
  }

  public function getPasswordHash() {
    return $this->passwordHash;
  }

  public function getEncryptionIv() {
    return $this->encryptionIv;
  }

  public function getRetriesLeft() {
    return $this->retriesLeft;
  }

  public function getExpires() {
    return $this->expires;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function setText($text) {
    $this->text = $text;
    return $this;
  }

  public function setPasswordHash($passwordHash) {
    $this->passwordHash = $passwordHash;
    return $this;
  }

  public function setRetriesLeft($retriesLeft) {
    $this->retriesLeft = $retriesLeft;
    return $this;
  }

  public function setExpires($expires) {
    $this->expires = $expires;
    return $this;
  }

  public function setEncryptionIv($iv) {
    $this->encryptionIv = $iv;
    return $this;
  }
}
