<?php
// Wrapper para processar registo evitando acesso direto a /includes/
if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
  require_once __DIR__ . '/includes/helpers.php';
  site_redirect('/views/register_view.php');
}
require_once __DIR__ . '/includes/register_process.php';
