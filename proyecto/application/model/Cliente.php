<?php

/**
 * Created by PhpStorm.
 * User: RodriC
 * Date: 1/9/18
 * Time: 14:43
 */
class Cliente {
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $ruc;

    /**
     * @var string
     */
    private $nombreFantasia;

    /**
     * @var string
     */
    private $razonSocial;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $tsAlta;

    /**
     * @var Usuario
     */
    public $usuarioAlta;

    /**
     * Comercio constructor.
     * @param ClienteBuilder $builder
     */
    public function __construct(ClienteBuilder $builder) {
        $this->id = $builder->id;
        $this->ruc = $builder->ruc;
        $this->nombreFantasia = $builder->nombreFantasia;
        $this->razonSocial = $builder->razonSocial;
        $this->email = $builder->email;
        $this->telefono = $builder->telefono;
        $this->direccion = $builder->direccion;
        $this->observaciones = $builder->observaciones;
        $this->tsAlta = $builder->tsAlta;
        $this->usuarioAlta = $builder->usuarioAlta;
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
    public function getRuc(): string {
        return $this->ruc;
    }

    /**
     * @return string
     */
    public function getNombreFantasia(): string {
        return $this->nombreFantasia;
    }

    /**
     * @return string
     */
    public function getRazonSocial(): string {
        return $this->razonSocial;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function getTelefono(): ?string {
        return $this->telefono;
    }

    /**
     * @return null|string
     */
    public function getDireccion(): ?string {
        return $this->direccion;
    }

    /**
     * @return null|string
     */
    public function getObservaciones(): ?string {
        return $this->observaciones;
    }

    /**
     * @return string
     */
    public function getTsAlta(): string {
        return $this->tsAlta;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioAlta(): Usuario {
        return $this->usuarioAlta;
    }
}