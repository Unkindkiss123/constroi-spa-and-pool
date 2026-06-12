<?php
// Wrapper para processar redefinição evitando acesso direto a /includes/
if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
  require_once __DIR__ . '/includes/helpers.php';
  site_redirect('/views/redefinir_view.php');
}
require_once __DIR__ . '/includes/redefinir_password.php';
