<?php
function cargar_env(string $ruta): void
{
    if (!is_file($ruta)) {
        return;
    }

    $variables = parse_ini_file($ruta, false, INI_SCANNER_RAW);
    if ($variables === false) {
        throw new RuntimeException('El archivo .env no tiene un formato válido.');
    }

    foreach ($variables as $nombre => $valor) {
        if (getenv($nombre) === false) {
            putenv($nombre . '=' . $valor);
            $_ENV[$nombre] = $valor;
        }
    }
}

function env_requerida(string $nombre): string
{
    $valor = getenv($nombre);
    if ($valor === false || $valor === '') {
        throw new RuntimeException("Falta la variable de entorno {$nombre}.");
    }
    return $valor;
}

cargar_env(__DIR__ . '/.env');

define('DB_HOST', env_requerida('DB_HOST'));
define('DB_PORT', env_requerida('DB_PORT'));
define('DB_NAME', env_requerida('DB_NAME'));
define('DB_USER', env_requerida('DB_USER'));
define('DB_PASS', env_requerida('DB_PASS'));

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
