<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
$page_title = 'Construção de Piscinas | Constrói Spa & Pool';
$page_description = 'Projetos de piscinas em betão/tela com acabamentos premium e qualidade garantida.';
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/../componentes/header.php';
?>
<?php $tituloPagina='Construção de Piscinas'; $subtituloPagina='Projetos à medida'; $pageClass='servicos'; include __DIR__.'/../componentes/page_hero.php'; ?>

<section class="py-4 text-dark" aria-label="Serviço de construção de piscinas">
  <div class="container">
  <?= render_picture('/public/imagens/wave.png', 'Ilustração decorativa ondulada azul', 'img-fluid rounded shadow-sm mb-4', 'lazy', '240px') ?>
    <div class="text-start">
      <h4>Porquê escolher a Constrói Spa &amp; Pool?</h4>
      <p>Usamos materiais de alta durabilidade, sistemas eficientes e acompanhamento técnico de qualidade. Cada projeto é executado com atenção ao detalhe e ao conforto do cliente.</p>
      <h4>Serviços incluídos:</h4>
      <ul>
        <li>Construção de piscinas em betão armado ou bloco</li>
        <li>Instalação de equipamentos e sistemas de filtragem</li>
        <li>Acabamentos personalizados (mosaico, pastilha, tela, pedra natural)</li>
      </ul>
    </div>
  </div>
</section>
<div class="text-center mt-4 mb-5">
  <a href="/constroi_spa_and_pool/views/contactos_view.php" class="btn btn-primary">Pedir Orçamento</a>
</div>
<?php include __DIR__ . '/../componentes/footer.php'; ?>
