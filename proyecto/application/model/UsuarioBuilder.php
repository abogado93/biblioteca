<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/12/18
 * Time: 11:03
 */

class UsuarioBuilder
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $usuario;

    /**
     * @var string
     */
    public $nombres;

    /**
     * @var string
     */
    public $apellidos;

    /**
     * @var Password
     */
    public $password;

    /**
     * @var string
     */
    public $ultimoAcceso;

    /**
     * @var int
     */
    public $accesoIntentos;

    /**
     * @var bool
     */
    public $bloqueado;

    /**
     * @var string
     */
    public $bloqueadoTs;

    /**
     * @var string
     */
    public $tsAlta;

    /**
     * @var string
     */
    public $tsBaja;

    /**
     * UsuarioBuilder constructor.
     * @param string $usuario
     */
    public function __construct(string $usuario) {
        $this->usuario = $usuario;
    }

    /**
     * @return Usuario
     */
    public function build() : Usuario {
        return new Usuario($this);
    }
}