<?php
/**
 * CONFIGURACIÓN GLOBAL — EL FARO (faro6)
 * Colocar en: /faro6/config.php
 */

// ============================
// Ajustes básicos del sitio
// ============================
define('SITE_NAME', 'EL FARO');

// Usa SIEMPRE Apache en puerto 80 (XAMPP). Cambia solo si mueves el proyecto.
define('BASE_URL', 'http://localhost/faro6');  // <- ajusta aquí si cambias carpeta/puerto

// ============================
// Sesión
// ============================
if (session_status() !== PHP_SESSION_ACTIVE) {
  // Puedes personalizar el nombre de la sesión para evitar colisiones
  session_name('faro6_session');
  session_start();
}

// ============================
// Carga de base de datos (PDO)
// ============================
// Tu archivo actual está en /faro6/auth/db.php y expone $pdo (PDO conectado)
$__dbPath = __DIR__ . '/auth/db.php';
if (file_exists($__dbPath)) {
  require_once $__dbPath; // define $pdo
} else {
  // Si no existe, no rompemos la app; solo advertimos en modo dev
  // echo "ADVERTENCIA: No se encontró auth/db.php";
}

// ============================
// Helpers de URL
// ============================

/**
 * Construye una URL absoluta dentro del proyecto (respeta BASE_URL).
 * Ej: url('/auth/login.php') -> http://localhost/faro6/auth/login.php
 */
function url(string $path = '/'): string {
  $path = '/' . ltrim($path, '/');
  return rtrim(BASE_URL, '/') . $path;
}

/**
 * Redirecciona a una ruta del proyecto (usa BASE_URL).
 * Ej: redirect('/index.php?welcome=1');
 */
function redirect(string $path = '/'): never {
  header('Location: ' . url($path));
  exit;
}

// ============================
// Helpers de sesión/usuario
// ============================

/** ¿Hay usuario autenticado? */
function isLoggedIn(): bool {
  return !empty($_SESSION['user_id']);
}

/** Nombre del usuario autenticado (o cadena vacía) */
function currentUserName(): string {
  return $_SESSION['user_name'] ?? '';
}

/** ID del usuario autenticado (o null) */
function currentUserId(): ?int {
  return isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
}

/** Requiere sesión; si no hay, manda a login */
function requireLogin(string $returnTo = '/index.php'): void {
  if (!isLoggedIn()) {
    // puedes pasar ?next= para volver luego
    redirect('/auth/login.php?next=' . urlencode($returnTo));
  }
}

// ============================
// CSRF helpers
// ============================

/** Obtiene (y crea si no existe) el token CSRF de la sesión */
function csrf_token(): string {
  if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf'];
}

/** Imprime un input hidden con el CSRF (para poner dentro de <form>) */
function csrf_field(): void {
  echo '<input type="hidden" name="csrf" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}

/** Valida el token CSRF recibido por POST */
function csrf_validate_from_post(): bool {
  if (!isset($_POST['csrf'], $_SESSION['csrf'])) return false;
  return hash_equals($_SESSION['csrf'], $_POST['csrf']);
}

// ============================
// Utils de salida
// ============================

/** Escapar HTML seguro */
function e(string $str): string {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/** Muestra saludo compacto para navbar */
function navbarGreeting(): string {
  return '👋 Hola, <strong>' . e(currentUserName()) . '</strong>';
}

// ============================
// Modo desarrollo (opcional)
// ============================
// Habilita errores mientras desarrollas; comenta en producción.
if (!headers_sent()) {
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
}
