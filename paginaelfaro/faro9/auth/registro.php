<?php
// /faro6/auth/registro.php
session_start();
require __DIR__ . '/db.php';

// CSRF simple
if (empty($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

$isLogged  = !empty($_SESSION['user_id']);
$userName  = $_SESSION['user_name'] ?? '';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // CSRF
  if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    $errores[] = 'Token inválido. Recarga la página.';
  } else {
    // Campos
    $nombre = trim($_POST['nombre'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $pass   = $_POST['password'] ?? '';
    $pass2  = $_POST['password2'] ?? '';

    // Validaciones
    if ($nombre === '' || mb_strlen($nombre) < 3)       $errores[] = 'Ingresa un nombre válido (mínimo 3 caracteres).';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))     $errores[] = 'Email inválido.';
    if (strlen($pass) < 6)                              $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
    if ($pass !== $pass2)                               $errores[] = 'Las contraseñas no coinciden.';

    if (!$errores) {
      try {
        // ¿email existe?
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
          $errores[] = 'El email ya está registrado.';
        } else {
          // Crear usuario
          $hash = password_hash($pass, PASSWORD_DEFAULT);
          $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, email, password_hash) VALUES (?, ?, ?)');
          $stmt->execute([$nombre, $email, $hash]);

          // Inicia sesión automáticamente
          $newId = $pdo->lastInsertId();
          $_SESSION['user_id']   = $newId;
          $_SESSION['user_name'] = $nombre;

          // Refresca CSRF y redirige al inicio
          $_SESSION['csrf'] = bin2hex(random_bytes(32));
          header('Location: /faro6/index.php?welcome=1'); 
          exit;
        }
      } catch (Throwable $e) {
        $errores[] = 'Error al registrar: ' . $e->getMessage();
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Registro — EL FARO</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap 5 + Icons (los mismos que usas en el sitio) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    :root{ --faro-dark:#0b2239; }
    body{ background:#f7f9fc; }
    .navbar{ box-shadow: 0 2px 12px rgba(0,0,0,.06); }
    .card{ border:0; box-shadow:0 6px 20px rgba(0,0,0,.06); }
    .brand-title{ font-family: "Bebas Neue", system-ui, sans-serif; letter-spacing: 1px; }
  </style>
  <!-- Fuente Bebas como en el index -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
</head>
<body>

  <!-- NAVBAR (igual estilo que el index) -->
  <nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="/faro6/index.php">
        <i class="bi bi-lightbulb-fill text-warning fs-4" aria-hidden="true"></i>
        <span class="d-flex flex-column lh-1">
          <span class="brand-title fs-3">EL FARO</span>
          <small class="text-muted">Siempre al servicio de la información</small>
        </span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Abrir navegación">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item"><a class="nav-link" href="/faro6/index.php"><i class="bi bi-house-door me-1"></i>Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="/faro6/deporte.php"><i class="bi bi-trophy me-1"></i>Deportes</a></li>
          <li class="nav-item"><a class="nav-link" href="/faro6/negocios.php"><i class="bi bi-briefcase me-1"></i>Negocios</a></li>
          <li class="nav-item"><a class="nav-link" href="/faro6/noticias.php"><i class="bi bi-newspaper me-1"></i>Noticias</a></li>

          <?php if (!$isLogged): ?>
            <!-- Si NO hay sesión: mostrar Registro y Login -->
            <li class="nav-item">
              <a class="btn btn-outline-primary ms-lg-2" href="/faro6/auth/login.php">
                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión
              </a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ms-lg-2" href="/faro6/auth/registro.php">
                <i class="bi bi-person-plus me-1"></i> Regístrate
              </a>
            </li>
          <?php else: ?>
            <!-- Si hay sesión: saludo + logout -->
            <li class="nav-item d-flex align-items-center ms-lg-3">
              <span class="badge text-bg-light text-dark">
                👋 Hola, <strong><?= htmlspecialchars($userName) ?></strong>
              </span>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-danger ms-lg-2" href="/faro6/auth/logout.php">
                <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- CONTENIDO -->
  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card p-4">
          <h1 class="h4 mb-3"><i class="bi bi-person-plus me-2"></i>Crear cuenta</h1>

          <?php if ($errores): ?>
            <div class="alert alert-danger">
              <ul class="mb-0">
                <?php foreach ($errores as $err): ?>
                  <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="post" novalidate>
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

            <div class="mb-3">
              <label class="form-label" for="nombre">Nombre</label>
              <input class="form-control" type="text" id="nombre" name="nombre" required minlength="3"
                     value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
            </div>

            <div class="mb-3">
              <label class="form-label" for="email">Email</label>
              <input class="form-control" type="email" id="email" name="email" required
                     value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="password">Contraseña</label>
                <input class="form-control" type="password" id="password" name="password" required minlength="6">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="password2">Repite la contraseña</label>
                <input class="form-control" type="password" id="password2" name="password2" required minlength="6">
              </div>
            </div>

            <div class="form-check my-3">
              <input class="form-check-input" type="checkbox" id="tyc" required>
              <label class="form-check-label" for="tyc">Acepto términos y condiciones</label>
            </div>

            <button class="btn btn-primary w-100" type="submit">
              <i class="bi bi-person-check-fill me-1"></i> Registrarme
            </button>

            <?php if (!$isLogged): ?>
              <p class="text-center small text-muted mt-3 mb-0">
                ¿Ya tienes cuenta? <a href="/faro6/auth/login.php">Inicia sesión</a>
              </p>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- FOOTER opcional (mismo estilo del sitio) -->
  <footer class="pt-5" style="background:#0f2740;color:#dbe6f4;">
    <div class="container">
      <hr class="my-4 border-light-subtle" />
      <p class="text-center small mb-0">Hecho con <i class="bi bi-heart-fill text-danger"></i> y Bootstrap 5.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
