document.querySelector('.menu-boton')?.addEventListener('click', function () {
  const nav = document.querySelector('.navegacion');
  const abierto = nav.classList.toggle('abierto');
  this.setAttribute('aria-expanded', abierto);
});

document.querySelectorAll('.ver-password').forEach((boton) => {
  boton.addEventListener('click', () => {
    const input = boton.previousElementSibling;
    const visible = input.type === 'text';
    input.type = visible ? 'password' : 'text';
    boton.textContent = visible ? 'Ver' : 'Ocultar';
    boton.setAttribute('aria-label', visible ? 'Mostrar contraseña' : 'Ocultar contraseña');
  });
});
