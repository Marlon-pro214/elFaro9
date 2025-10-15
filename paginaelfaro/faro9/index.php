<?php /* /index.php (clásico con barra lateral de login/registro) */ ?>
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
    .brand-title{ font-family: 'Georgia', serif; letter-spacing:.5px; }
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
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <h1 class="display-5 brand-title">El diario de siempre</h1>
        <p class="lead-text">Cobertura sobria y verificada: país, mundo, deportes y negocios.</p>
      </div>
      <div class="col-lg-4">
        <form class="d-flex" role="search" action="#" method="get">
          <input class="form-control me-2" type="search" name="q" placeholder="Buscar..." aria-label="Buscar">
          <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </div>
  </div>
</section>

<main class="container py-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <h2 class="section-title">Titulares</h2>

      <article class="mb-4 pb-4 border-bottom">
        <div class="kicker">País</div>
        <h3 class="h2">Agenda legislativa entra en semana clave</h3>
        <p class="byline">Redacción — Hoy</p>
        <p>Comisiones y plenarios definen votaciones con foco en seguridad y crecimiento.</p>
        <a class="link-primary" href="noticias.php">Seguir leyendo</a>
      </article>

      <article class="mb-4 pb-4 border-bottom">
        <div class="kicker">Mundo</div>
        <h3 class="h2">Cumbres internacionales acuerdan hoja climática</h3>
        <p class="byline">Agencias — Hoy</p>
        <p>Metas de mitigación y financiamiento verde, con revisiones anuales.</p>
      </article>

      <article class="mb-4 pb-4 border-bottom">
        <div class="kicker">Deportes</div>
        <h3 class="h2">La fecha deja marcadores ajustados</h3>
        <p class="byline">Redacción Deportes — Hoy</p>
        <p>Los punteros mantienen la ventaja; destacadas actuaciones en el mediocampo.</p>
      </article>
    </div>

    <div class="col-lg-4">
      <h2 class="section-title">Barra lateral</h2>

      <!-- Acceso (Login) -->
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
          <strong><i class="bi bi-box-arrow-in-right me-1"></i> Acceder</strong>
        </div>
        <div class="card-body">
          <form method="post" action="/auth/login.php" novalidate>
            <div class="mb-3">
              <label class="form-label" for="loginEmail">Correo</label>
              <input class="form-control" type="email" id="loginEmail" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="loginPass">Contraseña</label>
              <input class="form-control" type="password" id="loginPass" name="password" required>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                <label class="form-check-label" for="remember">Recordarme</label>
              </div>
              <button class="btn btn-dark btn-sm" type="submit">Entrar</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Registro -->
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
          <strong><i class="bi bi-person-plus me-1"></i> ¿No tienes cuenta?</strong>
        </div>
        <div class="card-body">
          <p class="mb-3">Crea tu cuenta para comentar y recibir boletines.</p>
          <a class="btn btn-outline-dark w-100" href="/auth/registro.php">Regístrate</a>
        </div>
      </div>

      <!-- En breve -->
      <div class="card shadow-sm">
        <div class="card-header bg-white">
          <strong><i class="bi bi-lightning-charge me-1"></i> En breve</strong>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><i class="bi bi-dot"></i> Mercados locales operan mixtos al cierre.</li>
          <li class="list-group-item"><i class="bi bi-dot"></i> Convocatoria de selecciones juveniles.</li>
          <li class="list-group-item"><i class="bi bi-dot"></i> Nueva ruta aérea regional abre competencia.</li>
        </ul>
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
