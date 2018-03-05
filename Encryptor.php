<?php
namespace Pastebin;
use RuntimeException;

class Encryptor {
  private $encryptionMethod = 'AES-256-CBC';
  private $iv = '';
  private $encryptionKey = '';

  public function __construct($encryptionKey) {
    if ($encryptionKey == '') {
      throw new RuntimeException('Encryption key must not be empty.');
    }

    $this->encryptionKey = $encryptionKey;
    $this->iv = openssl_random_pseudo_bytes(
      openssl_cipher_iv_length($this->encryptionMethod)
    );
  }

  public function encrypt($plainText) {
    $options = 0;

    return openssl_encrypt(
      $plainText,
      $this->encryptionMethod,
      $this->encryptionKey,
      $options,
      $this->iv
    );
  }

  public function decrypt($encrypted) {
    $options = 0;

    return openssl_decrypt(
      $encrypted,
      $this->encryptionMethod,
      $this->encryptionKey,
      $options,
      $this->iv
    );
  }

  public function numMethodsAvailable() {
    $methods = openssl_get_cipher_methods();
    return count($methods);
  }

  public function setIv($iv) {
    $this->iv = $iv;
    return $this;
  }

  public function getIv() {
    return $this->iv;
  }
}
