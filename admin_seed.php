<?php
// Wrapper para executar o seeder de admin sem aceder diretamente a /includes/
// Uso (apenas em DEV): http://localhost/constroi_spa_and_pool/admin_seed.php

require_once __DIR__ . '/includes/config.php';
if (!defined('IS_LOCAL') || !IS_LOCAL) {
    http_response_code(403);
    echo '<h1>403 Forbidden</h1><p>Seeder apenas disponível em ambiente local.</p>';
    exit;
}

require_once __DIR__ . '/includes/seed_admin.php';
