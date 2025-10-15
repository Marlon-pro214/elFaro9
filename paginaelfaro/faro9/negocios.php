<?php /* /negocios.php (clásico) */ ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EL FARO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body{ background:#f6f4ef; color:#212529; }
    .masthead{ background:#12263a; color:#fff; }
    .brand-title{ font-family: 'Georgia', serif; letter-spacing: .5px; }
    .navbar-nav .nav-link{ font-weight:500; }
    .section-title{ font-family:'Georgia', serif; border-bottom:2px solid #12263a; padding-bottom:.25rem; margin-bottom:1rem; }
    .lead-text{ font-size:1.05rem; }
    .byline{ color:#6c757d; font-size:.9rem; }
    .hero-classic{ background:#e9ecef; }
    .hero-classic .container{ padding:2rem 0; }
    .footer{ background:#12263a; color:#dbe6f4; }
    .footer a{ color:#dbe6f4; text-decoration:none; }
    .footer a:hover{ text-decoration:underline; }
    .kicker{ text-transform:uppercase; letter-spacing:.08em; font-size:.8rem; color:#6c757d; }
  </style>
</head>
<body>
<header class="masthead py-3 border-bottom border-2 border-warning">
  <div class="container d-flex flex-wrap align-items-center justify-content-between">
    <a class="d-flex align-items-center text-white text-decoration-none" href="index.php">
      <i class="bi bi-lightbulb-fill text-warning fs-3 me-2"></i>
      <span class="brand-title h3 mb-0">EL FARO</span>
    </a>
    <ul class="nav">
      <li class="nav-item"><a class="nav-link text-white" href="index.php">Inicio</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="deporte.php">Deportes</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="negocios.php">Negocios</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="noticias.php">Noticias</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="contacto.php">Contacto</a></li>
    </ul>
  </div>
</header>

<section class="hero-classic">
  <div class="container">
    <h1 class="brand-title mb-0">Negocios</h1>
    <p class="byline">Mercados, empresas y emprendimiento</p>
  </div>
</section>

<main class="container py-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <h2 class="section-title">Mercados</h2>
      <article class="mb-4 pb-4 border-bottom">
        <div class="kicker">Internacional</div>
        <h3 class="h2">Materias primas repuntan</h3>
        <p class="byline">Economía — Hoy</p>
        <p>Cobre y litio avanzan; analistas revisan proyecciones de inversión.</p>
      </article>
      <article class="mb-4 pb-4 border-bottom">
        <div class="kicker">Empresas</div>
        <h3 class="h2">Ronda abre oportunidades para pymes</h3>
        <p class="byline">Emprendimiento — Hoy</p>
        <p>Capacitaciones, financiamiento y networking para crecer.</p>
      </article>
    </div>
    <div class="col-lg-4">
      <h2 class="section-title">Indicadores</h2>
      <div class="p-3 bg-white border rounded">
        <div class="row text-center">
          <div class="col-4"><small>USD</small><div class="h5 mb-0">—</div></div>
          <div class="col-4"><small>Cobre</small><div class="h5 mb-0">—</div></div>
          <div class="col-4"><small>IPC</small><div class="h5 mb-0">—</div></div>
        </div>
        <p class="small text-muted mb-0 mt-2">Valores referenciales.</p>
      </div>
    </div>
  </div>
</main>
<footer class="footer mt-5 py-4">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="brand-title h5">EL FARO</div>
        <p class="small mb-0">&copy; 2025 EL FARO — Todos los derechos reservados.</p>
      </div>
      <div class="col-md-6 d-flex align-items-center justify-content-md-end gap-3 fs-4">
        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" aria-label="X"><i class="bi bi-twitter-x"></i></a>
        <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
      </div>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

