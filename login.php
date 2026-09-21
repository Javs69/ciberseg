<?php
require_once __DIR__ . '/seguridad.php';
if (usuario_autenticado()) { header('Location: panel.php'); exit; }
$error = ''; $email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verificar_csrf();
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !is_string($password)) {
        $error = 'Correo o contraseña incorrectos.';
    } else {
        try {
            $consulta = db()->prepare('SELECT id, nombre, password_hash FROM usuarios WHERE email = :email LIMIT 1');
            $consulta->execute(['email' => $email]); $usuario = $consulta->fetch();
            if ($usuario && password_verify($password, $usuario['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = (int)$usuario['id']; $_SESSION['usuario_nombre'] = $usuario['nombre'];
                db()->prepare('UPDATE usuarios SET ultimo_acceso = CURRENT_TIMESTAMP WHERE id = :id')->execute(['id' => $usuario['id']]);
                header('Location: panel.php'); exit;
            }
            $error = 'Correo o contraseña incorrectos.';
        } catch (PDOException $e) { $error = 'No se pudo conectar con la base de datos.'; }
    }
}
$titulo = 'Iniciar sesión'; require __DIR__ . '/header.php';
?>
<section class="auth"><div class="auth-caja"><a class="volver" href="index.php">← Volver al inicio</a><p class="eyebrow">BIENVENIDO DE NUEVO</p><h1>Inicia sesión.</h1><p class="subtexto">Accede a tu espacio de CodeGuard.</p>
<?php if ($error): ?><div class="alerta error"><?= e($error) ?></div><?php endif; ?>
<form method="post" novalidate><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<label for="email">Correo electrónico</label><input id="email" type="email" name="email" maxlength="150" autocomplete="email" value="<?= e($email) ?>" required>
<label for="password">Contraseña</label><div class="campo-password"><input id="password" type="password" name="password" autocomplete="current-password" required><button type="button" class="ver-password" aria-label="Mostrar contraseña">Ver</button></div>
<button class="boton boton-ancho" type="submit">Entrar a mi cuenta →</button></form><p class="alternativa">¿Aún no tienes cuenta? <a href="registro.php">Crear cuenta</a></p></div></section>
<?php require __DIR__ . '/footer.php'; ?>
