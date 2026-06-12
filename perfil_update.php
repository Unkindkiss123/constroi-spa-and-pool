<?php
// Wrapper para processar atualização de perfil evitando acesso direto a /includes/
if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
  require_once __DIR__ . '/includes/helpers.php';
  site_redirect('/views/perfil_view.php');
}
require_once __DIR__ . '/includes/perfil_update.php';
