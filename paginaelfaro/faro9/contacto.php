<?php /* /contacto.php (clásico con alertas y ticket) */ ?>
<?php
  // Variables esperadas: $ok (bool), $errors (array de strings), $old (array con nombre, email, mensaje), $_SESSION['csrf']
  if (!isset($ok)) $ok = false;
  if (!isset($errors)) $errors = [];
  if (!isset($old)) $old = ['nombre'=>'', 'email'=>'', 'mensaje'=>''];

  // Genera un ticket si el envío fue correcto o si viene desde el controlador
  if ($ok && empty($ticket)) {
    $ticket = 'EF-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
  }
?>
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

<main class="container py-5" style="max-width:820px;">
  <h1 class="section-title">Contacto</h1>
  <div class="card p-4 shadow-sm">

    <?php if ($ok): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        ¡Gracias! Tu mensaje fue enviado correctamente.
        <?php if (!empty($ticket)): ?>
          <div class="mt-1">
            Este es tu número de ticket: <strong><?= htmlspecialchars($ticket) ?></strong>
          </div>
        <?php endif; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>

    <?php if ($errors): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-1"></i>
        Por favor corrige los siguientes errores:
        <ul class="mb-0 mt-2">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>

    <form method="post" novalidate class="needs-validation" id="contactForm">
      <input type="hidden" name="csrf" value="<?= isset($_SESSION['csrf']) ? htmlspecialchars($_SESSION['csrf']) : '' ?>">

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label" for="nombre">Nombre</label>
          <input
            class="form-control <?= (isset($old['nombre']) && trim($old['nombre'])==='' && !$ok) ? 'is-invalid' : '' ?>"
            type="text" id="nombre" name="nombre" required minlength="3"
            value="<?= htmlspecialchars($old['nombre']) ?>">
          <div class="invalid-feedback">
            Debes rellenar este campo (mínimo 3 caracteres).
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label" for="email">Correo electrónico</label>
          <input
            class="form-control <?= (isset($old['email']) && trim($old['email'])==='' && !$ok) ? 'is-invalid' : '' ?>"
            type="email" id="email" name="email" required
            value="<?= htmlspecialchars($old['email']) ?>">
          <div class="invalid-feedback">
            Debes ingresar un correo válido.
          </div>
        </div>

        <div class="col-12">
          <label class="form-label" for="mensaje">Mensaje</label>
          <textarea
            class="form-control <?= (isset($old['mensaje']) && trim($old['mensaje'])==='' && !$ok) ? 'is-invalid' : '' ?>"
            id="mensaje" name="mensaje" rows="5" required minlength="10"
            placeholder="Cuéntanos en qué podemos ayudarte."><?= htmlspecialchars($old['mensaje']) ?></textarea>
          <div class="invalid-feedback">
            Debes rellenar este campo (mínimo 10 caracteres).
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-dark">
          <i class="bi bi-send-fill me-1"></i> Enviar
        </button>
      </div>
    </form>
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
<script>
// Validación Bootstrap + mensajes "debe rellenar esto"
(() => {
  const form = document.getElementById('contactForm');
  form.addEventListener('submit', (event) => {
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.classList.add('was-validated');
  });
})();
</script>
</body>
</html>
