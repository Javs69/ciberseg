<?php require_once __DIR__ . '/seguridad.php'; requerir_login(); $titulo = 'Mi panel'; require __DIR__ . '/header.php'; ?>
<section class="panel"><p class="eyebrow">ÁREA DE CLIENTES</p><h1>Hola, <?= e($_SESSION['usuario_nombre']) ?>.</h1>
<?php if (isset($_GET['bienvenida'])): ?><div class="alerta exito">Tu cuenta fue creada correctamente. ¡Bienvenido a CodeGuard!</div><?php endif; ?>
<p class="intro">Tu acceso está protegido. Desde aquí podrás consultar el avance de tus proyectos.</p>
<div class="panel-grid"><article><span>01</span><h3>Cuéntanos tu idea</h3><p>Define los objetivos de tu proyecto.</p></article><article><span>02</span><h3>Recibe una propuesta</h3><p>Analizamos el alcance y la seguridad.</p></article><article><span>03</span><h3>Construimos contigo</h3><p>Desarrollamos una solución sólida.</p></article></div><a class="boton" href="index.php#servicios">Conocer servicios →</a></section>
<?php require __DIR__ . '/footer.php'; ?>
