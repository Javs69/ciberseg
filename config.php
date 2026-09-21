<?php
/* Configuración de PostgreSQL. Ajusta estos valores a tu instalación local. */
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'codeguard_db');
define('DB_USER', 'postgres');
define('DB_PASS', 'TU_CONTRASENA_DE_POSTGRES');

function db(): PDO
{
    static $conexion = null;
    if ($conexion === null) {
        $dsn = 'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
        $conexion = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
    return $conexion;
}
