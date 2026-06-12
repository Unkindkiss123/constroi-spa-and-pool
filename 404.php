<?php
require_once __DIR__ . '/includes/db_connect.php';
require_once __DIR__ . '/includes/helpers.php';
$menuItems = get_menu_items($conn, 'principal');
$page_title = 'Página não encontrada | Constrói Spa & Pool';
$page_description = 'A página que procuras pode ter sido removida, ter o seu nome alterado ou estar temporariamente indisponível.';
include __DIR__ . '/componentes/header.php';
?>
<main id="conteudo" class="pt-3 pb-5">
  <div class="container-xl text-dark">
    <div class="p-4 p-md-5 bg-white shadow-sm rounded-3 text-center">
      <h1 class="display-6 text-primary mb-2">Erro 404</h1>
      <p class="lead text-muted mb-4">Ups! Não encontrámos a página.</p>
      <a class="btn btn-primary" href="<?= htmlspecialchars(url_for('/index.php')) ?>">Voltar à página inicial</a>
    </div>
  </div>
</main>
<?php include __DIR__ . '/componentes/footer.php'; ?>
