<?php
// Wrapper para processar login evitando acesso direto a /includes/
if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
  require_once __DIR__ . '/includes/helpers.php';
  site_redirect('/views/login_view.php');
}
require_once __DIR__ . '/includes/login_process.php';
