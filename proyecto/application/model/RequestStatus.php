<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/7/18
 * Time: 10:35
 */
class RequestStatus
{
    // El pedido se pudo procesar correctamente.
    const OK = "OK";

    // Sesión expirada
    const SESSION_EXPIRED = "SESSION_EXPIRED";

    // Credenciales inválidas
    const NOT_AUTHORIZED = "NOT_AUTHORIZED";

    // Controlador / método no encontrado
    const BAD_REQUEST = "BAD_REQUEST";

    // No hay conexión con la base de datos, tabla no encontrada, etc.
    const DATABASE_ERROR = "DATABASE_ERROR";
    
    // Cuando un registro que se quiere eliminar está siendo referenciado por otra tabla.
    // Cuando se está intentando referenciar un registro con una identificador inexistente.
    const FOREIGN_KEY_VIOLATION = "FOREIGN_KEY_VIOLATION";

    const DUPLICATE_KEY = "DUPLICATE_KEY";

    // Cuando no
    const ROW_NOT_FOUND = "KEY_NOT_FOUND";
}