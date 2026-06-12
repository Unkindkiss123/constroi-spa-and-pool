<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/../componentes/header.php';
?>
<?php $tituloPagina='Acompanhamento em Obra'; $subtituloPagina='Planeamento, fiscalização e prazos'; $pageClass='servicos'; include __DIR__.'/../componentes/page_hero.php'; ?>

<section class="py-4 text-dark" aria-label="Serviço de acompanhamento em obra">
  <div class="container">
  <?= render_picture('/public/imagens/wave.png', 'Gráfico de onda decorativo', 'img-fluid rounded shadow-sm mb-4', 'lazy', '240px') ?>
    <div class="text-start">
      <h4>O que fazemos</h4>
      <ul>
        <li>Planeamento e coordenação das atividades</li>
        <li>Controlo de qualidade e conformidade técnica</li>
        <li>Relatórios de progresso e comunicação com o cliente</li>
      </ul>
    </div>
  </div>
</section>
<div class="text-center mt-4 mb-5">
  <a href="/constroi_spa_and_pool/views/contactos_view.php" class="btn btn-primary">Pedir Orçamento</a>
</div>
<?php include __DIR__ . '/../componentes/footer.php'; ?>
