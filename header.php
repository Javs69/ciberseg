<?php require_once __DIR__ . '/seguridad.php'; ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CodeGuard: desarrollo web seguro para tu negocio.">
    <title><?= isset($titulo) ? e($titulo) . ' | ' : '' ?>CodeGuard</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
<header class="barra">
    <a class="marca" href="index.php"><span>&lt;/&gt;</span> CodeGuard</a>
    <button class="menu-boton" aria-label="Abrir menú" aria-expanded="false">☰</button>
    <nav class="navegacion">
        <a href="index.php#servicios">Servicios</a>
        <a href="index.php#seguridad">Seguridad</a>
        <?php if (usuario_autenticado()): ?>
            <a href="panel.php">Mi panel</a>
            <a class="enlace-salir" href="logout.php">Salir</a>
        <?php else: ?>
            <a href="login.php">Iniciar sesión</a>
            <a class="boton boton-nav" href="registro.php">Crear cuenta</a>
        <?php endif; ?>
    </nav>
</header>
<main>
