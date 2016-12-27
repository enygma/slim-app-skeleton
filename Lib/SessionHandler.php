<?php

namespace Lib;

use Defuse\Crypto\Crypto;

class SessionHandler extends \SessionHandler
{
    /**
     * Encryption key
     * @var string
     */
    private $key;

    /**
     * Init the session handler and set the current encryption key
     *
     * @param string $key Encryption key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Read the encrypted data from the session ID provided
     *
     * @param string $id Session ID
     * @return string Data found if session ID is valid
     */
    public function read($id)
    {
        $data = parent::read($id);
        return (strlen($data) > 0) ? $this->decrypt($data) : $data;
    }

    /**
     * Write the encrypted session data with the ID provided
     *
     * @param string $id Session ID
     * @param mixed $data Data to write to session
     * @return boolean Result of session write
     */
    public function write($id, $data)
    {
        $data = $this->encrypt($data);
        return parent::write($id, $data);
    }

    /**
     * Encrypt the data using the Defuse Security library
     *
     * @param mixed $data Data to encrypt
     * @return string Encrypted ciphertext
     */
    private function encrypt($data)
    {
        return Crypto::encrypt($data, $this->key);
    }

    /**
     * Decrypt the data using the Defuse Security library
     *
     * @param string $data Ciphertext data
     * @return mixed Decrypted data
     */
    private function decrypt($data)
    {
        return Crypto::decrypt($data, $this->key);
    }
}
