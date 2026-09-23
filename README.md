# CodeGuard — sitio web seguro

Proyecto sin frameworks: HTML/CSS/JavaScript para el front-end y PHP nativo con PostgreSQL para el back-end.

## Preparación en pgAdmin

1. En pgAdmin crea una base de datos llamada `codeguard_db`.
2. Selecciona esa base, abre **Query Tool**, copia y ejecuta el contenido de `database.sql`.
3. Copia `.env.example` como `.env` y configura las credenciales de tu usuario PostgreSQL. No subas `.env` al repositorio.
4. Asegúrate de que PHP tenga habilitada la extensión `pdo_pgsql`.

## Ejecutar

En la carpeta del proyecto abre PowerShell y ejecuta:

```powershell
php -S localhost:3030
```

Después visita `http://localhost:3030`.

## Seguridad que se puede exponer

- Contraseñas con hash seguro mediante `password_hash()` y verificación con `password_verify()`.
- Consultas preparadas PDO: evita inyección SQL.
- Token CSRF en formularios de registro e inicio de sesión.
- Validación tanto de campos como de longitud y complejidad de contraseña.
- Escape HTML con `htmlspecialchars()` para prevenir XSS.
- Sesiones con cookies `HttpOnly`, `SameSite=Lax` y regeneración del identificador después del acceso.
