<?php
// /faro6/auth/login.php
session_start();
require __DIR__ . '/db.php';

$isLogged = !empty($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? '';
$errores  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $pass  = $_POST['password'] ?? '';

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = 'Email inválido.';
  if ($pass === '')                               $errores[] = 'Ingresa tu contraseña.';

  if (!$errores) {
    $stmt = $pdo->prepare('SELECT id, nombre, password_hash FROM usuarios WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $u = $stmt->fetch();
    if ($u && password_verify($pass, $u['password_hash'])) {
      $_SESSION['user_id']   = $u['id'];
      $_SESSION['user_name'] = $u['nombre'];
      header('Location: /faro6/index.php?welcome=1'); exit;
    } else {
      $errores[] = 'Credenciales inválidas.';
    }
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Iniciar sesión </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
  <style>
    body{ background:#f7f9fc; }
    .navbar{ box-shadow:0 2px 12px rgba(0,0,0,.06); }
    .card{ border:0; box-shadow:0 6px 20px rgba(0,0,0,.06); }
    .brand-title{ font-family:"Bebas Neue",sans-serif; letter-spacing:1px; }
  </style>
</head>
<body>
  <!-- Navbar igual al index, con botones dinámicos -->
  <nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="/faro6/index.php">
        <i class="bi bi-lightbulb-fill text-warning fs-4"></i>
        <span class="d-flex flex-column lh-1">
          <span class="brand-title fs-3">EL FARO</span>
          <small class="text-muted">Siempre al servicio de la información</small>
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item"><a class="nav-link" href="/faro6/index.php"><i class="bi bi-house-door me-1"></i>Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="/faro6/deporte.php"><i class="bi bi-trophy me-1"></i>Deportes</a></li>
          <li class="nav-item"><a class="nav-link" href="/faro6/negocios.php"><i class="bi bi-briefcase me-1"></i>Negocios</a></li>
          <li class="nav-item"><a class="nav-link" href="/faro6/noticias.php"><i class="bi bi-newspaper me-1"></i>Noticias</a></li>
          <?php if (!$isLogged): ?>
            <li class="nav-item">
              <a class="btn btn-outline-primary ms-lg-2" href="/faro6/auth/login.php"><i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ms-lg-2" href="/faro6/auth/registro.php"><i class="bi bi-person-plus me-1"></i> Regístrate</a>
            </li>
          <?php else: ?>
            <li class="nav-item d-flex align-items-center ms-lg-3">
              <span class="badge text-bg-light text-dark">👋 Hola, <strong><?= htmlspecialchars($userName) ?></strong></span>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-danger ms-lg-2" href="/faro6/auth/logout.php"><i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-5">
        <div class="card p-4">
          <h1 class="h4 mb-3"><i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión</h1>

          <?php if ($errores): ?>
            <div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errores as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul></div>
          <?php endif; ?>

          <form method="post" novalidate>
            <div class="mb-3">
              <label class="form-label" for="email">Email</label>
              <input class="form-control" type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            <div class="mb-3">
              <label class="form-label" for="password">Contraseña</label>
              <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <button class="btn btn-primary w-100" type="submit">Entrar</button>
            <p class="text-center small mt-3 mb-0">¿No tienes cuenta? <a href="/faro6/auth/registro.php">Regístrate</a></p>
          </form>
        </div>
      </div>
    </div>
  </main>

  <footer class="pt-5" style="background:#0f2740;color:#dbe6f4;">
    <div class="container">
      <hr class="my-4 border-light-subtle" />
      <p class="text-center small mb-0">Hecho con <i class="bi bi-heart-fill text-danger"></i> y Bootstrap 5.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
