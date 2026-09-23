<?php
require_once __DIR__ . '/seguridad.php';
if (usuario_autenticado()) { header('Location: panel.php'); exit; }
$errores = [];
$nombre = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificar_csrf();
    $nombre = trim($_POST['nombre'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirmacion = $_POST['confirmacion'] ?? '';
    if (mb_strlen($nombre) < 2 || mb_strlen($nombre) > 80) {
        $errores[] = 'Escribe un nombre de 2 a 80 caracteres.';
    } elseif (!preg_match("/^[\\p{L}\\p{M}]+(?:[ .'-][\\p{L}\\p{M}]+)*$/u", $nombre)) {
        $errores[] = 'El nombre solo puede contener letras, espacios, guiones o apóstrofes.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) $errores[] = 'Escribe un correo electrónico válido.';
    if (strlen($password) < 10 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) $errores[] = 'La contraseña debe tener al menos 10 caracteres, mayúscula, minúscula y número.';
    if ($password !== $confirmacion) $errores[] = 'Las contraseñas no coinciden.';
    if (!$errores) {
        try {
            $consulta = db()->prepare('INSERT INTO usuarios (nombre, email, password_hash) VALUES (:nombre, :email, :hash) RETURNING id');
            $consulta->execute(['nombre' => $nombre, 'email' => $email, 'hash' => password_hash($password, PASSWORD_DEFAULT)]);
            $nuevoUsuario = $consulta->fetch();
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = (int) $nuevoUsuario['id'];
            $_SESSION['usuario_nombre'] = $nombre;
            header('Location: panel.php?bienvenida=1'); exit;
        } catch (PDOException $e) {
            $errores[] = $e->getCode() === '23505' ? 'Este correo ya está registrado.' : 'No se pudo crear la cuenta. Revisa la conexión a la base de datos.';
        }
    }
}
$titulo = 'Crear cuenta'; require __DIR__ . '/header.php';
?>
<section class="auth"><div class="auth-caja"><a class="volver" href="index.php">← Volver al inicio</a><p class="eyebrow">NUEVA CUENTA</p><h1>Empecemos juntos.</h1><p class="subtexto">Crea tu cuenta para conocer nuestros servicios.</p>
<?php if ($errores): ?><div class="alerta error"><strong>Revisa lo siguiente:</strong><ul><?php foreach ($errores as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form method="post" novalidate>
<input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<label for="nombre">Nombre completo</label><input id="nombre" name="nombre" maxlength="80" autocomplete="name" inputmode="text" data-solo-letras value="<?= e($nombre) ?>" required>
<label for="email">Correo electrónico</label><input id="email" type="email" name="email" maxlength="150" autocomplete="email" required>
<label for="password">Contraseña</label><div class="campo-password"><input id="password" type="password" name="password" autocomplete="new-password" required><button type="button" class="ver-password" aria-label="Mostrar contraseña">Ver</button></div><small class="ayuda">Mínimo 10 caracteres con mayúscula, minúscula y número.</small>
<label for="confirmacion">Confirmar contraseña</label><input id="confirmacion" type="password" name="confirmacion" autocomplete="new-password" required>
<button class="boton boton-ancho" type="submit">Crear cuenta →</button>
</form><p class="alternativa">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p></div></section>
<?php require __DIR__ . '/footer.php'; ?>
