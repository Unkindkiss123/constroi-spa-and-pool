<?php
// Auto-detect BASE_URL for premium uniform paths
$httpsOn = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ((int)($_SERVER['SERVER_PORT'] ?? 0) === 443);
$protocol = $httpsOn ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

// Determine the base web path of the project (works under subfolder like /constroi_spa_and_pool)
$scriptDir = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) : '/';
// Normalize to include trailing slash for root-like dirs
if ($scriptDir === '\\' || $scriptDir === '.') { $scriptDir = '/'; }
$path = preg_replace('#/(admin|includes|views)(/.*)?$#', '/', $scriptDir);
$baseUrl = rtrim($protocol . $host . $path, '/') . '/';

if (!defined('BASE_URL')) {
  define('BASE_URL', $baseUrl);
}

// Optional: filesystem base path (project root on disk)
if (!defined('BASE_PATH')) {
  $root = realpath(__DIR__) ?: __DIR__;
  define('BASE_PATH', rtrim(str_replace('\\', '/', $root), '/') . '/');
}

// Optional: tiny url helper if not already provided by the app
if (!function_exists('url')) {
  function url(string $path = ''): string {
    $p = ltrim($path, '/');
    return BASE_URL . $p;
  }
}
