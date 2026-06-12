<?php
// Wrapper para processar contacto evitando acesso direto a /includes/
if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
  require_once __DIR__ . '/includes/helpers.php';
  site_redirect('/views/contactos_view.php');
}
require_once __DIR__ . '/includes/contact_process.php';
