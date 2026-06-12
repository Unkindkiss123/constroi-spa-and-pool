<?php
// Endpoint público para submissão de leads (orcamento/contacto).
// Mantém /includes fechado; este ficheiro apenas encaminha o POST.

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
  http_response_code(405);
  header('Allow: POST');
  exit('Método não permitido.');
}

if (empty($_POST)) {
  http_response_code(400);
  exit('Pedido inválido.');
}

// Encaminhar para o handler real (não mover lógica para aqui)
require_once __DIR__ . '/includes/form_submit.php';
