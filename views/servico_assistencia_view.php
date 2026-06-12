<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
$page_title = 'Assistência Técnica | Constrói Spa & Pool';
$page_description = 'Diagnóstico e reparação de sistemas de piscina com resposta rápida e eficaz.';
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/../componentes/header.php';
?>
<?php $tituloPagina='Assistência Técnica'; $subtituloPagina='Diagnóstico e reparações rápidas'; $pageClass='servicos'; include __DIR__.'/../componentes/page_hero.php'; ?>

<section class="py-4 text-dark" aria-label="Serviço de assistência técnica a piscinas">
  <div class="container">
  <?= render_picture('/public/imagens/wave.png', 'Ilustração onda decorativa', 'img-fluid rounded shadow-sm mb-4', 'lazy', '240px') ?>
    <div class="text-start">
      <h4>O que oferecemos</h4>
      <ul>
        <li>Diagnóstico e reparação de avarias</li>
        <li>Substituição de componentes e otimização de desempenho</li>
        <li>Manutenção preventiva para reduzir paragens</li>
      </ul>
    </div>
  </div>
</section>
<div class="text-center mt-4 mb-5">
  <a href="/constroi_spa_and_pool/views/contactos_view.php" class="btn btn-primary">Pedir Orçamento</a>
</div>
<?php include __DIR__ . '/../componentes/footer.php'; ?>
