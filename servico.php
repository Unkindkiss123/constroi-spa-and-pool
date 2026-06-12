<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db_connect.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/ServicosModel.php';

$model = new ServicosModel($conn);
$slug = (string)($_GET['slug'] ?? '');

// Middleware de 301 via redirects
if ($slug !== '') {
  $stmt = $conn->prepare('SELECT to_slug FROM redirects WHERE from_slug=? ORDER BY id DESC LIMIT 1');
  $stmt->bind_param('s', $slug);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($row = $res->fetch_assoc()) {
    $to = (string)$row['to_slug'];
    if ($to !== '' && $to !== $slug) {
      header('Location: ' . url('servico.php?slug=' . urlencode($to)), true, 301);
      exit;
    }
  }
  $stmt->close();
}

$svc = $slug !== '' ? $model->obterPorSlug($slug) : null;

$menuItems = get_menu_items($conn, 'principal');
$page_title = $svc && !empty($svc['seo_title']) ? $svc['seo_title'] : ($svc['titulo'] ?? 'Serviço');
$page_description = $svc && !empty($svc['seo_description']) ? $svc['seo_description'] : ($svc['resumo_curto'] ?? '');

include __DIR__ . '/componentes/header.php';

if (!$svc) {
  http_response_code(404);
  echo '<main class="text-dark py-5"><div class="container"><div class="alert alert-warning">Serviço não encontrado.</div></div></main>';
  include __DIR__ . '/componentes/footer.php';
  exit;
}
?>

<?php $tituloPagina = h($svc['titulo']); $subtituloPagina = h($svc['resumo_curto']); $pageClass='servico'; include __DIR__ . '/componentes/page_hero.php'; ?>

<main id="conteudo" class="text-dark py-4">
  <div class="container-xl">
    <div class="row g-4">
      <div class="col-lg-7">
        <article class="bg-white shadow-sm rounded-3 p-3 p-md-4">
          <div class="mb-3">
            <?php if (!empty($svc['imagem_principal'])): ?>
              <img src="<?= h(url($svc['imagem_principal'])) ?>" alt="Imagem do serviço" class="img-fluid rounded">
            <?php endif; ?>
          </div>
          <div class="content">
            <?= nl2br(h($svc['descricao_longa'])) ?>
          </div>
        </article>
      </div>
      <div class="col-lg-5">
        <aside class="bg-white shadow-sm rounded-3 p-3 p-md-4">
          <h2 class="h5">Interessado neste serviço?</h2>
          <?php $t = (string)$svc['tipo']; ?>
          <?php if ($t==='manutencao'): ?>
            <p>Este é um serviço de manutenção. Contacte-nos para agendar.</p>
            <a class="btn btn-primary" href="<?= h(url('contactos.php')) ?>">Agendar / Pedir slot</a>
          <?php elseif ($t==='preco_fixo'): ?>
            <p>Peça um orçamento para este serviço.</p>
            <a class="btn btn-primary" href="<?= h(url('orcamento.php?servico='.urlencode($svc['titulo']))) ?>">Pedir orçamento</a>
          <?php else: ?>
            <p>Inicie um pedido personalizado connosco.</p>
            <a class="btn btn-primary" href="<?= h(url('orcamento.php?servico='.urlencode($svc['titulo']))) ?>">Iniciar pedido</a>
          <?php endif; ?>
        </aside>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . '/componentes/footer.php'; ?>
