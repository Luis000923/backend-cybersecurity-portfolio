<?php
declare(strict_types=1);

$d = require __DIR__ . '/includes/data.php';

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$desc   = $d['role'] . '. ' . $d['tagline'];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($d['name']) ?> — <?= e($d['role']) ?></title>
  <meta name="description" content="<?= e($desc) ?>">
  <meta name="theme-color" content="#0b0c0f">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= e($d['site_url']) ?>/">
  <meta name="twitter:card" content="summary_large_image">
  <meta property="og:title" content="<?= e($d['name']) ?>">
  <meta property="og:description" content="<?= e($d['role']) ?>">
  <meta property="og:image" content="<?= e($d['site_url']) ?>/assets/img/perfil.jpg">
  <link rel="canonical" href="<?= e($d['site_url']) ?>/">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400&display=swap">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/main.js" defer></script>
</head>
<body>

<header class="nav">
  <div class="wrap nav-in">
    <a class="logo" href="#top" aria-label="Inicio">LG</a>
    <button class="nav-toggle" aria-label="Menú" aria-expanded="false" aria-controls="menu"><span></span><span></span></button>
    <nav id="menu" class="menu">
      <a href="#sobre-mi">Sobre mí</a>
      <a href="#skills">Skills</a>
      <a href="#proyectos">Proyectos</a>
      <a href="#documentos">Documentos</a>
      <a href="#galeria">Galería</a>
      <a href="#contacto">Contacto</a>
      <a class="btn btn-sm" href="<?= e($d['cv']) ?>" target="_blank" rel="noopener">CV</a>
    </nav>
  </div>
</header>

<main id="top">

  <section class="hero wrap">
    <div class="hero-text">
      <p class="eyebrow"><span class="dot"></span> Disponible · <?= e($d['location']) ?></p>
      <h1><?= e($d['name']) ?></h1>
      <p class="role"><?= e($d['role']) ?></p>
      <p class="lead"><?= e($d['tagline']) ?></p>
      <div class="actions">
        <a class="btn btn-primary" href="#proyectos">Ver proyectos</a>
        <a class="btn" href="#contacto">Contactar</a>
        <a class="btn btn-ghost" href="<?= e($d['github']) ?>" target="_blank" rel="noopener">GitHub ↗</a>
        <a class="btn btn-ghost" href="<?= e($d['hackenproof']) ?>" target="_blank" rel="noopener">HackenProof ↗</a>
      </div>
    </div>
    <figure class="portrait">
      <img src="assets/img/perfil.jpg" alt="Retrato de <?= e($d['name']) ?>" width="900" height="675" fetchpriority="high">
    </figure>
  </section>

  <section class="wrap stats" aria-label="Resumen">
    <?php foreach ($d['stats'] as [$n, $l]): ?>
      <div><strong><?= e($n) ?></strong><span><?= e($l) ?></span></div>
    <?php endforeach; ?>
  </section>

  <section id="sobre-mi" class="wrap section">
    <h2><span class="num">01</span> Sobre mí</h2>
    <div class="about">
      <div class="prose">
        <?php foreach ($d['about'] as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
      </div>
      <ol class="timeline">
        <?php foreach ($d['timeline'] as [$t, $desc]): ?>
          <li><strong><?= e($t) ?></strong><span><?= e($desc) ?></span></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <section id="skills" class="wrap section">
    <h2><span class="num">02</span> Tecnologías</h2>
    <div class="skills">
      <div class="bars">
        <?php $maxN = max(array_column($d['languages'], 1));
        foreach ($d['languages'] as [$name, $n]): $pct = (int) round($n / $maxN * 100); ?>
          <div class="bar">
            <div class="bar-head"><span><?= e($name) ?></span><span class="mono"><?= $n ?> <?= $n === 1 ? 'proyecto' : 'proyectos' ?></span></div>
            <div class="track"><i style="--w:<?= $pct ?>%"></i></div>
          </div>
        <?php endforeach; ?>
        <p class="note">Número de proyectos públicos de GitHub por lenguaje.</p>
      </div>
      <div class="groups">
        <?php foreach ($d['skills'] as $group => $items): ?>
          <div class="group">
            <h3><?= e($group) ?></h3>
            <ul class="chips"><?php foreach ($items as $i): ?><li><?= e($i) ?></li><?php endforeach; ?></ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section id="proyectos" class="wrap section">
    <h2><span class="num">03</span> Proyectos</h2>
    <div class="projects">
      <?php foreach ($d['projects'] as [$title, $featured, $text, $tags, $url]): ?>
        <a class="card<?= $featured ? ' featured' : '' ?>" href="<?= e($url) ?>" target="_blank" rel="noopener">
          <div class="card-top">
            <h3><?= e($title) ?></h3>
            <?php if ($featured): ?><span class="badge">Destacado</span><?php endif; ?>
          </div>
          <p><?= e($text) ?></p>
          <ul class="chips small"><?php foreach ($tags as $t): ?><li><?= e($t) ?></li><?php endforeach; ?></ul>
          <span class="go">Ver repositorio ↗</span>
        </a>
      <?php endforeach; ?>
    </div>
    <p class="more"><a href="<?= e($d['github']) ?>?tab=repositories" target="_blank" rel="noopener">Ver todos en GitHub ↗</a></p>
  </section>

  <section id="documentos" class="wrap section">
    <h2><span class="num">04</span> Documentos</h2>
    <div class="docs">
      <?php foreach ($d['documents'] as [$type, $title, $meta, $file]):
        $href = 'files/' . rawurlencode($file); ?>
        <article class="doc">
          <span class="badge"><?= e($type) ?></span>
          <h3><?= e($title) ?></h3>
          <p><?= e($meta) ?></p>
          <div class="doc-actions">
            <a class="btn btn-sm" href="<?= e($href) ?>" target="_blank" rel="noopener">Ver PDF ↗</a>
            <a class="btn btn-sm btn-ghost" href="<?= e($href) ?>" download>Descargar</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section id="galeria" class="wrap section">
    <h2><span class="num">05</span> Galería</h2>
    <div class="gallery">
      <?php foreach ($d['gallery'] as $i => $img): ?>
        <button class="shot" type="button" data-src="assets/img/<?= e($img) ?>.jpg" aria-label="Ampliar imagen <?= $i + 1 ?>">
          <img src="assets/img/<?= e($img) ?>.jpg" alt="Imagen <?= $i + 1 ?> de la galería" loading="lazy">
        </button>
      <?php endforeach; ?>
    </div>
  </section>

  <section id="contacto" class="wrap section">
    <h2><span class="num">06</span> Contacto</h2>
    <div class="contact">
      <div>
        <p class="big">¿Interesado en colaborar?</p>
        <p class="prose">Busco mi primera posición como analista junior de ciberseguridad, AppSec o automatización de seguridad. Si tienes una oportunidad o quieres colaborar, escríbeme.</p>
        <p><a class="link" href="<?= e($d['whatsapp']) ?>" target="_blank" rel="noopener">WhatsApp: <?= e($d['phone']) ?></a></p>
        <p class="links">
          <a class="link" href="<?= e($d['linkedin']) ?>" target="_blank" rel="noopener">LinkedIn ↗</a>
          <a class="link" href="<?= e($d['github']) ?>" target="_blank" rel="noopener">GitHub ↗</a>
          <a class="link" href="<?= e($d['hackenproof']) ?>" target="_blank" rel="noopener">HackenProof ↗</a>
        </p>
      </div>
      <form id="contact-form" action="api/contact.php" method="post" novalidate>
        <label>Nombre<input name="name" required minlength="2" maxlength="80" autocomplete="name"></label>
        <label>Email<input name="email" type="email" required maxlength="120" autocomplete="email"></label>
        <label>Mensaje<textarea name="message" rows="5" required minlength="10" maxlength="3000"></textarea></label>
        <input class="hp" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
        <button class="btn btn-primary" type="submit">Enviar mensaje</button>
        <p class="status" role="status" aria-live="polite"></p>
      </form>
    </div>
  </section>

</main>

<footer class="foot">
  <div class="wrap foot-in">
    <span>© <?= date('Y') ?> <?= e($d['name']) ?></span>
    <span class="mono">PHP · HTML · CSS · JS</span>
  </div>
</footer>

<dialog id="lightbox"><img alt=""><button type="button" aria-label="Cerrar">✕</button></dialog>

</body>
</html>
