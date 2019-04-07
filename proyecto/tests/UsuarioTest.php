<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/13/18
 * Time: 09:23
 */

use PHPUnit\Framework\TestCase;
class UsuarioTest extends TestCase
{

    public function testUserRegistration() {

        $password = PasswordUtil::createHash("admin123456");

        $builder = new UsuarioBuilder("administrador");

        $builder->nombres = "Juan";
        $builder->apellidos = "Perez";
        $builder->password = $password;
        $builder->ultimoAcceso = "2018-03-28 10:00:00";
        $builder->accesoIntentos = 0;
        $builder->bloqueado = false;

        try {

            UsuarioDao::register($builder->build());

        } catch (PDOException $e) {

            // Sólo tiene que fallar si el usuario existe
            $this->assertTrue($e->getCode() == 23505);
        }

        $usuario = UsuarioDao::getByUserIdentifier("administrador");
        $this->assertNotNull($usuario);
    }
}