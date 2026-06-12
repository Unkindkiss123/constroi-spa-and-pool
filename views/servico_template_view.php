<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
$page_title = 'Serviço — Constrói Spa & Pool';
$page_description = 'Página genérica de serviço. Texto descritivo e call-to-action.';
$breadcrumb = [
  ['label'=>'Início','href'=>'/'],
  ['label'=>'Serviços','href'=>'/servicos.php'],
  ['label'=>'Serviço','href'=>null]
];
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/../componentes/header.php';
?>
<?php $tituloPagina='Serviço'; $subtituloPagina='Descrição breve'; $pageClass='servicos'; include __DIR__.'/../componentes/page_hero.php'; ?>

<main id="conteudo" class="container my-4 text-dark">

  <!-- Conteúdo -->
  <section class="py-4 py-md-5">
    <div class="container-xl">
      
      <div class="row g-4">
        <div class="col-lg-8">
          <article class="bg-white shadow-sm rounded-3 p-4">
            <h2 class="h4 text-primary">Sobre este serviço</h2>
            <p class="text-muted">Texto detalhado sobre o serviço. Estrutura preparada para conteúdo futuro, sem lógica adicional no momento.</p>
            <ul class="text-muted">
              <li>Benefício 1</li>
              <li>Benefício 2</li>
              <li>Benefício 3</li>
            </ul>
            <a href="<?= htmlspecialchars($url_for('/contactos.php')) ?>" class="btn btn-primary btn-lg">Pedir orçamento</a>
          </article>
        </div>
        <div class="col-lg-4">
          <aside class="bg-white shadow-sm rounded-3 p-4 h-100">
            <h3 class="h6 text-primary">Informação rápida</h3>
            <ul class="text-muted mb-0">
              <li>Prazo médio: —</li>
              <li>Zona de atuação: Vidigueira e região</li>
              <li>Garantia: —</li>
            </ul>
          </aside>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../componentes/footer.php'; ?>
