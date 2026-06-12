<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/../componentes/header.php';
?>
<?php $tituloPagina='Construção Civil'; $subtituloPagina='Obras complementares e acabamentos'; $pageClass='servicos'; include __DIR__.'/../componentes/page_hero.php'; ?>

<section class="py-4 text-dark" aria-label="Serviços de construção civil complementares">
  <div class="container">
  <?= render_picture('/public/imagens/wave.png', 'Onda decorativa para construção civil', 'img-fluid rounded shadow-sm mb-4', 'lazy', '240px') ?>
    <div class="text-start">
      <h4>Especialidades</h4>
      <ul>
        <li>Revestimentos e pavimentos exteriores</li>
        <li>Alvenarias, betão e estruturas de suporte</li>
        <li>Integração com iluminação e paisagismo</li>
      </ul>
    </div>
  </div>
</section>
<div class="text-center mt-4 mb-5">
  <a href="/constroi_spa_and_pool/views/contactos_view.php" class="btn btn-primary">Pedir Orçamento</a>
</div>
<?php include __DIR__ . '/../componentes/footer.php'; ?>
