<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/14/18
 * Time: 16:49
 */

class ClienteBuilder
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $ruc;

    /**
     * @var string
     */
    public $nombreFantasia;

    /**
     * @var string
     */
    public $razonSocial;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $telefono;

    /**
     * @var string
     */
    public $direccion;

    /**
     * @var string
     */
    public $observaciones;

    /**
     * @var string
     */
    public $tsAlta;

    /**
     * @var Usuario
     */
    public $usuarioAlta;

    /**
     * ComercioBuilder constructor.
     * @param int|null $id
     */
    public function __construct(?int $id) {
        $this->id = $id;
    }

    /**
     * @return Cliente
     */
    public function build() : Cliente {
        return new Cliente($this);
    }

}