<?php

namespace Lib;

use Defuse\Crypto\Crypto;

class EncryptionManager
{
    /**
     * Current encryption key
     * @var string
     */
    private $key;

    /**
     * Init the object and set up the current encryption key
     *
     * @param string $key Encryption key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Encrypt the data provided
     *
     * @param mixed $data Data to encrypt
     * @return string Encrypted data result
     */
    public function encrypt($data)
    {
        return Crypto::encrypt($data, $this->key);
    }

    /**
     * Decrypt the provided data
     *
     * @param mixed $data Data to decrypt
     * @return mixed Decrypted data result
     */
    public function decrypt($data)
    {
        return Crypto::decrypt($data, $this->key);
    }
}
