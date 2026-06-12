<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/../componentes/header.php';
?>
<?php $tituloPagina='Manutenção'; $subtituloPagina='Água impecável todo o ano'; $pageClass='servicos'; include __DIR__.'/../componentes/page_hero.php'; ?>

<section class="py-4 text-dark" aria-label="Serviço de manutenção de piscinas">
  <div class="container">
  <?= render_picture('/public/imagens/wave.png', 'Onda decorativa para manutenção', 'img-fluid rounded shadow-sm mb-4', 'lazy', '240px') ?>
    <div class="text-start">
      <h4>Inclui</h4>
      <ul>
        <li>Limpeza e aspiração periódica</li>
        <li>Verificação de parâmetros da água</li>
        <li>Inspeção de equipamentos e consumíveis</li>
      </ul>
    </div>
  </div>
</section>
<div class="text-center mt-4 mb-5">
  <a href="/constroi_spa_and_pool/views/contactos_view.php" class="btn btn-primary">Pedir Orçamento</a>
</div>
<?php include __DIR__ . '/../componentes/footer.php'; ?>
