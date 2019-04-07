<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/12/18
 * Time: 10:42
 */

class Password
{
    private $salt, $hash;

    public function __construct(){}
    public function __clone(){}

    public function withHashAndSalt($hash, $salt) {

        if ($hash === null || $salt === null) {
            throw new PasswordException("Parámetros incorrectos. El hash o el salt proveído es núlo.");
        }

        $instance = new self();

        $instance->hash = trim($hash);
        $instance->salt = trim($salt);

        return $instance;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param mixed $salt
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = trim($salt);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = trim($hash);
        return $this;
    }
}