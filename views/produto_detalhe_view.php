<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/funcoes_produtos.php';
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/../componentes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$produto = $id ? getProdutoById($conn, $id) : null;
if (!$produto) {
  echo "<div class='container my-5'><div class='alert alert-warning'>Produto não encontrado.</div></div>";
  include __DIR__ . '/../componentes/footer.php';
  exit;
}

$imgs = $produto['imagens_adicionais'] ?? [];
// Normalizar caminho de imagem para funcionar em /views sob subpastas
function _resolve_img(?string $p = null): string {
  $fallback = '../public/imagens/logo_no_text.png';
  if (!$p) return $fallback;
  if (preg_match('#^https?://#i', $p)) return $p;
  $base = '/' . basename(dirname(__DIR__));
  if ($p[0] === '/') {
    if (strpos($p, '/public/') === 0) return '..' . $p;
    if (strpos($p, $base . '/public/') === 0) return '..' . substr($p, strlen($base));
    return '..' . $p;
  }
  return $p;
}
$imgPrincipal = _resolve_img($produto['imagem_principal'] ?? null);
?>

<main class="container my-4 pt-0 pb-4" id="conteudo">
  <div class="text-dark">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="bg-white shadow-sm rounded-3 p-2 p-md-3">
          <div id="galeria-principal" class="ratio ratio-4x3">
            <?= render_picture(strpos($imgPrincipal,'../')===0? substr($imgPrincipal,2):$imgPrincipal, $produto['nome'], 'w-100 h-100 object-fit-cover rounded', 'lazy', '(max-width:768px) 100vw, 50vw') ?>
          </div>
        </div>
        <?php if (!empty($imgs)): ?>
        <div class="row g-2 mt-2">
          <?php foreach ($imgs as $im): ?>
            <div class="col-3">
              <a href="#" class="d-block thumb-swap" data-img="<?= h(strpos($im,'../')===0? substr($im,2):$im) ?>" aria-label="Ver imagem">
                <?= render_picture(strpos($im,'../')===0? substr($im,2):$im, 'Miniatura', 'w-100 rounded border', 'lazy', '88px') ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <div class="col-md-6">
        <div class="bg-white shadow-sm rounded-3 p-3 p-md-4 h-100">
          <h1 class="h4 text-primary mb-1"><?= h($produto['nome']) ?></h1>
          <div class="text-muted mb-2 small"><?= h($produto['marca'] ?: 'Marca') ?><?php if (!empty($produto['categoria'])): ?> · <?= h($produto['categoria']) ?><?php endif; ?></div>
          <div class="fs-3 fw-semibold text-primary mb-2">€<?= number_format((float)$produto['preco'], 2, ',', ' ') ?></div>
          <p class="mb-2"><strong>Stock:</strong> <?= (int)$produto['stock'] > 0 ? 'Em stock' : 'Esgotado' ?></p>
          <?php if (!empty($produto['assistencia'])): ?>
            <p class="mb-2"><span class="badge bg-info text-dark">Assistência e Instalação</span></p>
          <?php endif; ?>
          <?php if (!empty($produto['referencia'])): ?>
          <p class="mb-2"><strong>Ref.:</strong> <?= h($produto['referencia']) ?></p>
          <?php endif; ?>
          <?php if (!empty($produto['caracteristicas'])): ?>
          <p class="mb-3"><strong>Características:</strong> <?= h($produto['caracteristicas']) ?></p>
          <?php endif; ?>
          <div class="d-grid d-sm-flex gap-2">
            <?php if (!empty($produto['requer_orcamento'])): ?>
              <a href="#" class="btn btn-primary btn-lg">Pedir Orçamento</a>
            <?php else: ?>
              <button class="btn btn-primary btn-lg" disabled>Adicionar ao carrinho</button>
            <?php endif; ?>
            <a href="<?= htmlspecialchars($url_for('/produtos.php')) ?>" class="btn btn-outline-secondary btn-lg">Voltar</a>
          </div>
          <hr class="my-4">
          <h5 class="mb-2">Descrição</h5>
          <div class="text-muted"><?= nl2br(h($produto['descricao'] ?? '')) ?></div>
          <hr class="my-4">
          <h5 class="mb-2">Especificações Técnicas</h5>
          <?php if (!empty($produto['especificacoes_tecnicas'])): ?>
            <div class="text-muted"><?= nl2br(h($produto['especificacoes_tecnicas'])) ?></div>
          <?php else: ?>
            <div class="text-muted small">Contacta-nos para especificações técnicas detalhadas do produto.</div>
          <?php endif; ?>
          <hr class="my-4">
          <?php if (!empty($produto['assistencia'])): ?>
            <h5 class="mb-2">Assistência e Instalação</h5>
            <div class="text-muted small">Prestamos assistência técnica e instalação para este produto. Solicita um orçamento personalizado.</div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <hr class="my-5">
    <h3 class="mb-3">Produtos Relacionados</h3>
    <div class="row g-3 g-md-4">
      <?php
      // Exemplo simples: relacionados por mesma categoria (ativos) distintos do atual, limit 4
      $relacionados = [];
      if (!empty($produto['categoria'])) {
        $stmt = $conn->prepare('SELECT id, nome, preco, imagem_principal FROM produtos WHERE ativo=1 AND categoria = ? AND id <> ? ORDER BY criado_em DESC LIMIT 4');
        $stmt->bind_param('si', $produto['categoria'], $produto['id']);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($r = $res->fetch_assoc()) { $relacionados[] = $r; }
        $stmt->close();
      }
      if (!$relacionados) echo "<div class='col-12 text-muted'>Sem relacionados.</div>";
      foreach ($relacionados as $r):
        $img = $r['imagem_principal'] ?: '../public/imagens/logo_no_text.png';
      ?>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm">
            <div class="ratio ratio-4x3"><?= render_picture(strpos($img,'../')===0? substr($img,2):$img, $r['nome'], 'w-100 h-100', 'lazy', '(max-width:576px) 100vw, 25vw') ?></div>
            <div class="card-body d-flex flex-column">
              <h6 class="card-title mb-1" title="<?= h($r['nome']) ?>"><?= h($r['nome']) ?></h6>
              <div class="text-primary fw-semibold mb-2">€<?= number_format((float)$r['preco'],2,',',' ') ?></div>
              <a class="btn btn-outline-primary mt-auto" href="<?= htmlspecialchars($url_for('/views/produto_detalhe_view.php')) ?>?id=<?= (int)$r['id'] ?>">Ver</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>

<script>
// Troca a imagem principal ao clicar numa miniatura
document.addEventListener('click', function(ev){
  const a = ev.target.closest('.thumb-swap');
  if (!a) return;
  ev.preventDefault();
  const newImg = a.getAttribute('data-img');
  if (!newImg) return;
  const wrap = document.querySelector('#galeria-principal');
  if (!wrap) return;
  // Re-render com render_picture no servidor não é possível no cliente,
  // então apenas substituímos o <img> dentro do picture
  const pic = wrap.querySelector('picture');
  const img = pic ? pic.querySelector('img') : null;
  if (img) {
    img.src = newImg;
    img.removeAttribute('srcset');
  }
});
</script>

<!-- JSON-LD Product -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "<?= h($produto['nome']) ?>",
  "image": "<?= htmlspecialchars(asset_url(strpos($imgPrincipal,'../')===0? substr($imgPrincipal,2):$imgPrincipal)) ?>",
  "description": "<?= h(mb_substr(strip_tags((string)($produto['descricao'] ?? '')), 0, 160)) ?>",
  "sku": "<?= h((string)($produto['referencia'] ?? '')) ?>",
  "brand": {
    "@type": "Brand",
    "name": "<?= h((string)($produto['marca'] ?? 'Constrói Spa & Pool')) ?>"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "EUR",
    "price": "<?= htmlspecialchars(number_format((float)($produto['preco'] ?? 0), 2, '.', '')) ?>",
    "availability": "https://schema.org/<?= (int)($produto['stock'] ?? 0) > 0 ? 'InStock' : 'OutOfStock' ?>"
  }
}
</script>

<?php include __DIR__ . '/../componentes/footer.php'; ?>
