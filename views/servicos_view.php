<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
$page_title = 'Serviços | Constrói Spa & Pool';
$page_description = 'Do projeto à manutenção: construção de piscinas, assistência técnica, tela armada e mais.';
$breadcrumb = [
  ['label'=>'Início','href'=>'/'],
  ['label'=>'Serviços','href'=>null]
];
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/../componentes/header.php';
?>

<?php $tituloPagina='Serviços'; $subtituloPagina='Soluções completas para a sua piscina'; $pageClass='servicos'; include __DIR__.'/../componentes/page_hero.php'; ?>

<main class="container my-4 text-dark" id="conteudo">

  <!-- Serviços grid -->
  <section class="py-4 py-md-5">
    <div class="container-xl">
  <div class="row g-3 g-md-4 csp-reveal">
        <?php
          $servicos = [
            ['icon' => 'bi-building', 'title' => 'Construção de Piscinas', 'desc' => 'Projetos personalizados em betão, telas e acabamentos premium.', 'href' => '/views/servico_construcao_view.php'],
            ['icon' => 'bi-wrench-adjustable', 'title' => 'Assistência Técnica', 'desc' => 'Diagnóstico e reparação de equipamentos e sistemas.', 'href' => '/views/servico_assistencia_view.php'],
            ['icon' => 'bi-recycle', 'title' => 'Manutenção', 'desc' => 'Planos regulares de limpeza e controlo de qualidade da água.', 'href' => '/views/servico_manutencao_view.php'],
            ['icon' => 'bi-badge-hd', 'title' => 'Tela Armada', 'desc' => 'Colocação profissional de telas armadas com garantia.', 'href' => '/views/servico_tela_view.php'],
            ['icon' => 'bi-clipboard-check', 'title' => 'Acompanhamento em Obra', 'desc' => 'Supervisão técnica e controlo de qualidade em obra.', 'href' => '/views/servico_acompanhamento_view.php'],
            ['icon' => 'bi-bricks', 'title' => 'Construção Civil', 'desc' => 'Obras complementares e acabamentos exteriores.', 'href' => '/views/servico_civil_view.php'],
          ];
          foreach ($servicos as $s):
        ?>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body d-flex flex-column">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 icon-circle-56 icon-accent-bg">
                  <i class="bi <?= h($s['icon']) ?> fs-4"></i>
                </div>
                <h3 class="h5 text-primary"><?= h($s['title']) ?></h3>
                <p class="text-muted mb-3"><?= h($s['desc']) ?></p>
                <div class="mt-auto d-grid">
                  <a class="btn btn-outline-primary" href="<?= htmlspecialchars($url_for($s['href'])) ?>">Saiba mais</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-5 bg-light">
    <div class="container-xl">
      <div class="p-4 p-md-5 bg-white shadow-sm rounded-3 text-center">
        <h2 class="h3 text-primary mb-2">Quer transformar o seu espaço exterior?</h2>
        <p class="text-muted mb-3">Fale connosco e descubra a solução ideal para si.</p>
  <a href="<?= htmlspecialchars($url_for('/orcamento.php')) ?>" class="btn btn-primary btn-lg btn-orcamento">Pedir Orçamento</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../componentes/footer.php'; ?>
