(() => {
  // Menú móvil
  const toggle = document.querySelector('.nav-toggle');
  const menu = document.getElementById('menu');
  toggle.addEventListener('click', () => {
    const open = menu.classList.toggle('open');
    toggle.setAttribute('aria-expanded', open);
  });
  menu.addEventListener('click', (e) => {
    if (e.target.closest('a')) {
      menu.classList.remove('open');
      toggle.setAttribute('aria-expanded', false);
    }
  });

  // Aparición al hacer scroll (y barras de skills)
  const targets = document.querySelectorAll('.section, .hero, .stats');
  targets.forEach((el) => el.classList.add('reveal'));
  const io = new IntersectionObserver((entries) => {
    entries.forEach((en) => {
      if (en.isIntersecting) {
        en.target.classList.add('in');
        io.unobserve(en.target);
      }
    });
  }, { threshold: 0.12 });
  targets.forEach((el) => io.observe(el));

  // Lightbox
  const box = document.getElementById('lightbox');
  const boxImg = box.querySelector('img');
  document.querySelectorAll('.shot').forEach((b) =>
    b.addEventListener('click', () => {
      boxImg.src = b.dataset.src;
      box.showModal();
    })
  );
  box.addEventListener('click', () => box.close());

  // Formulario de contacto
  const form = document.getElementById('contact-form');
  const status = form.querySelector('.status');
  const btn = form.querySelector('button');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    status.className = 'status';
    if (!form.checkValidity()) {
      status.textContent = 'Revisa los campos: nombre, email válido y mensaje de al menos 10 caracteres.';
      status.classList.add('err');
      return;
    }
    btn.disabled = true;
    status.textContent = 'Enviando…';
    try {
      const res = await fetch(form.action, { method: 'POST', body: new FormData(form) });
      const data = await res.json();
      status.textContent = data.message;
      status.classList.add(data.ok ? 'ok' : 'err');
      if (data.ok) form.reset();
    } catch {
      status.textContent = 'Error de red. Inténtalo de nuevo.';
      status.classList.add('err');
    } finally {
      btn.disabled = false;
    }
  });
})();
