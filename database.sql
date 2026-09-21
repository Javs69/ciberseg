-- Ejecuta primero este archivo en pgAdmin (Query Tool) conectado a PostgreSQL.
-- Después crea una base de datos llamada codeguard_db y vuelve a ejecutar
-- desde la línea CREATE TABLE en adelante dentro de esa base.

CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_usuarios_email ON usuarios (email);

-- Usuario de demostración (contraseña: Demo2026!)
-- El registro normal crea hashes con password_hash() desde PHP.
INSERT INTO usuarios (nombre, email, password_hash)
VALUES ('Cuenta Demo', 'demo@codeguard.mx', '$2y$12$cnrQHH4RRA8e4gRfgwLhrOsbP02WMInzeavv1k0rLW4fQBiatUMkS')
ON CONFLICT (email) DO NOTHING;
