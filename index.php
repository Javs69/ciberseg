<?php
require_once __DIR__ . '/seguridad.php';
$titulo = 'Desarrollo seguro';
require __DIR__ . '/header.php';
?>
<section class="hero">
    <div class="hero-texto">
        <p class="eyebrow">DESARROLLO WEB SEGURO</p>
        <h1>Tu idea merece <em>código confiable.</em></h1>
        <p class="intro">Creamos sitios y sistemas web rápidos, modernos y pensados para proteger los datos de tu negocio desde la primera línea de código.</p>
        <div class="acciones">
            <?php if (usuario_autenticado()): ?>
                <a class="boton" href="panel.php">Ir a mi panel <span>→</span></a>
            <?php else: ?>
                <a class="boton" href="registro.php">Comenzar proyecto <span>→</span></a>
            <?php endif; ?>
            <a class="enlace-flecha" href="#servicios">Ver servicios ↓</a>
        </div>
    </div>
    <div class="codigo" aria-label="Ejemplo de código seguro">
        <div class="codigo-barra"><i></i><i></i><i></i><small>proyecto-seguro.js</small></div>
        <pre><code><b>const</b> proyecto = {
  seguridad: <span>true</span>,
  calidad: <span>'alta'</span>,
  futuro: <span>'escalable'</span>
};

<b>if</b> (proyecto.seguridad) {
  construirConConfianza();
}</code></pre>
    </div>
</section>
<section class="seccion" id="servicios">
    <p class="eyebrow">LO QUE HACEMOS</p><h2>Soluciones que impulsan tu negocio</h2>
    <div class="tarjetas">
        <article class="tarjeta"><div class="icono">◈</div><h3>Sitios web</h3><p>Páginas institucionales y tiendas en línea que convierten visitas en clientes.</p></article>
        <article class="tarjeta"><div class="icono">⌘</div><h3>Sistemas a medida</h3><p>Aplicaciones hechas para los procesos reales de tu equipo.</p></article>
        <article class="tarjeta"><div class="icono">⌁</div><h3>Seguridad web</h3><p>Revisión de riesgos y buenas prácticas para cuidar tu información.</p></article>
    </div>
</section>
<section class="franja" id="seguridad">
    <div><p class="eyebrow">SEGURIDAD INTEGRADA</p><h2>Proteger datos no es un extra. Es el punto de partida.</h2></div>
    <ul><li><b>✓</b> Contraseñas cifradas</li><li><b>✓</b> Consultas parametrizadas</li><li><b>✓</b> Protección contra CSRF</li><li><b>✓</b> Validación de formularios</li></ul>
</section>
<section class="cta"><p class="eyebrow">¿LISTO PARA EMPEZAR?</p><h2>Construyamos algo seguro.</h2>
    <?php if (usuario_autenticado()): ?>
        <a class="boton boton-claro" href="panel.php">Ir a mi panel →</a>
    <?php else: ?>
        <a class="boton boton-claro" href="registro.php">Crear mi cuenta →</a>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/footer.php'; ?>
