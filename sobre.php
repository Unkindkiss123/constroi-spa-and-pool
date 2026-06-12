<?php
require_once __DIR__ . '/includes/db_connect.php';
require_once __DIR__ . '/includes/helpers.php';
$page_title = 'Sobre · Constrói Spa & Pool';
$page_description = 'Conheça a Constrói Spa & Pool e a nossa missão.';
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/componentes/header.php';
?>

<?php $tituloPagina='Sobre'; $subtituloPagina='Quem somos e o que fazemos'; $pageClass='sobre'; include __DIR__.'/componentes/page_hero.php'; ?>

<main id="conteudo" class="text-dark py-4">
  <div class="container-xl">
    <div class="bg-white shadow-sm rounded-3 p-4 p-md-5">
      <h2 class="h4 text-primary mb-3">A nossa empresa</h2>
      <p class="text-muted">Placeholder institucional. Esta página será desenvolvida com texto, imagens e certificações.</p>
      <ul class="text-muted mb-0">
        <li>Experiência em construção de piscinas e obras complementares</li>
        <li>Assistência técnica e manutenção</li>
        <li>Compromisso com qualidade e garantia</li>
      </ul>
    </div>
  </div>
</main>

<?php include __DIR__ . '/componentes/footer.php'; ?>
