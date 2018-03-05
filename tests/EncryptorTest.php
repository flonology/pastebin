<?php
use PHPUnit\Framework\TestCase;
use Pastebin\Encryptor;

class EncryptorTest extends TestCase
{
  private $encryptor;

  public function setUp() {
    $this->encryptor = new Encryptor('Encryption Key');
  }

  public function testCanEncryptAndDecryptMessage() {
    $plainText = 'This is a test';

    $encrypted = $this->encryptor->encrypt($plainText);
    $this->assertNotEquals($plainText, $encrypted);

    $decrypted = $this->encryptor->decrypt($encrypted);
    $this->assertEquals($plainText, $decrypted);
  }

  public function testDoesNotDecryptWithDifferentIv() {
    $plainText = 'This is a test';

    $this->encryptor = new Encryptor('Same Key');
    $encrypted = $this->encryptor->encrypt($plainText);

    $this->encryptor = new Encryptor('Same Key');
    $decrypted = $this->encryptor->decrypt($encrypted);

    $this->assertFalse($decrypted);
  }

  public function testEncryptionMethodsAreAvailable() {
    $this->assertGreaterThan(0, $this->encryptor->numMethodsAvailable());
  }
}
