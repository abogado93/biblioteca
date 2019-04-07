<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/12/18
 * Time: 10:35
 */

class Usuario
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $usuario;

    /**
     * @var string
     */
    private $nombres;

    /**
     * @var string
     */
    private $apellidos;

    /**
     * @var Password
     */
    private $password;

    /**
     * @var string
     */
    private $ultimoAcceso;

    /**
     * @var int
     */
    private $accesoIntentos;

    /**
     * @var bool
     */
    private $bloqueado;

    /**
     * @var string
     */
    private $bloqueadoTs;

    /**
     * @var string
     */
    private $tsAlta;

    /**
     * @var string
     */
    private $tsBaja;

    /**
     * Usuario constructor.
     * @param UsuarioBuilder $builder
     */
    public function __construct(UsuarioBuilder $builder) {
        $this->id = $builder->id;
        $this->usuario = $builder->usuario;
        $this->nombres = $builder->nombres;
        $this->apellidos = $builder->apellidos;
        $this->password = $builder->password;
        $this->ultimoAcceso = $builder->ultimoAcceso;
        $this->accesoIntentos = $builder->accesoIntentos;
        $this->bloqueado = $builder->bloqueado;
        $this->bloqueadoTs = $builder->bloqueadoTs;
        $this->tsAlta = $builder->tsAlta;
        $this->tsBaja = $builder->tsBaja;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsuario(): string {
        return $this->usuario;
    }

    /**
     * @return string
     */
    public function getNombres(): string {
        return $this->nombres;
    }

    /**
     * @return string
     */
    public function getApellidos(): string {
        return $this->apellidos;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUltimoAcceso(): ?string {
        return $this->ultimoAcceso;
    }

    /**
     * @return int
     */
    public function getAccesoIntentos(): ?int {
        return $this->accesoIntentos;
    }

    /**
     * @return bool
     */
    public function isBloqueado() {
        // Fix temporal: cuando es false, no retorna ningún valor.
        return ($this->bloqueado == true) ? '1' : '0';
    }

    /**
     * @return string
     */
    public function getBloqueadoTs() : ?string {
        return $this->bloqueadoTs;
    }

    /**
     * @return string
     */
    public function getTsAlta() : ?string {
        return $this->tsAlta;
    }

    /**
     * @return string
     */
    public function getTsBaja() : ?string {
        return $this->tsBaja;
    }

    public function getUsuarioStatus() {

        if($this->isBloqueado()) {

            return '<span class="label label-danger label-white middle"> Bloqueado<span>';

        } else {

            return '<span class="label label-success label-white middle"> Activo<span>';
        }
    }
}