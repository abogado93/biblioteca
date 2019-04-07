<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/12/18
 * Time: 14:43
 */

class ActivationToken
{
    const TOKEN_LENGTH = 36;

    private $token, $error;

    /**
     * ActivationToken constructor.
     * @param $token
     */
    public function __construct($token) {
        $this->token = Owasp::sanitize(trim($token), Owasp::SQL);
        $this->validateToken();
    }

    private function validateToken() : void {

        $token_length = strlen($this->token);
        if($token_length < 36 || $token_length > 36) {
            $this->error = "Token de activación inválido";
            return;
        }

        try {
            UsuarioDao::invalidateActivationToken($this->token);

        } catch (InvalidActivationTokenException $e) {
            $this->error = "Token de activación inválido";
        }
    }

    /**
     * @return bool
     */
    public function isValid() {
        return $this->error === null;
    }

    /**
     * @return string
     */
    public function getErrorMsg() {
        return $this->error;
    }
}