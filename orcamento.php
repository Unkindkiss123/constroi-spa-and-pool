<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db_connect.php';
require_once __DIR__ . '/includes/helpers.php';
$page_title = 'Pedido de Orçamento | Constrói Spa & Pool';
$page_description = 'Solicite um orçamento rápido para os nossos serviços.';
$menuItems = get_menu_items($conn, 'principal');
include __DIR__ . '/componentes/header.php';
?>

<?php $tituloPagina='Pedido de Orçamento'; $subtituloPagina='Descreva o seu projeto ou necessidade'; $pageClass='contactos'; include __DIR__.'/componentes/page_hero.php'; ?>

<main id="conteudo" class="text-dark">
  <div class="container my-5">
    <div class="p-4 p-md-5 bg-white shadow-sm rounded-3">
      <h2 class="h4 text-primary mb-3">Pedir orçamento</h2>
      <?php if(isset($_GET['ok'])): ?>
        <div class="alert alert-success">Enviado com sucesso. Obrigado!</div>
      <?php elseif(isset($_GET['err'])): ?>
        <?php
          $map = [
            'val' => 'Por favor verifica os campos obrigatórios.',
            'csrf' => 'Sessão expirada. Atualiza a página e tenta de novo.',
            'captcha' => 'Validação reCAPTCHA falhou.',
            'db' => 'Ocorreu um erro ao gravar. Tenta mais tarde.'
          ];
        ?>
        <div class="alert alert-danger"><?= h($map[$_GET['err']] ?? 'Erro ao enviar.') ?></div>
      <?php endif; ?>
      <form method="post" action="<?= url('post_lead.php') ?>" enctype="multipart/form-data" class="row g-3">
        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
        <input type="hidden" name="source" value="orcamento">
        <input type="hidden" name="utm_source" value="<?= htmlspecialchars($_GET['utm_source'] ?? '') ?>">
        <input type="hidden" name="utm_medium" value="<?= htmlspecialchars($_GET['utm_medium'] ?? '') ?>">
        <input type="hidden" name="utm_campaign" value="<?= htmlspecialchars($_GET['utm_campaign'] ?? '') ?>">
        <input type="text" name="website" value="" autocomplete="off" style="position:absolute;left:-9999px;top:-9999px">

        <div class="col-md-6">
          <label class="form-label">Nome *</label>
          <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email *</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Telefone *</label>
          <input type="tel" name="telefone" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Serviço</label>
          <select name="servico" class="form-select">
            <?php
              require_once __DIR__ . '/includes/ServicosModel.php';
              $m = new ServicosModel($conn);
              $opts = $m->listarPublicosParaSelect();
              $sv = (string)($_GET['servico'] ?? '');
            ?>
            <?php if (!$opts): ?>
              <option value="" disabled>Sem serviços disponíveis de momento</option>
            <?php else: ?>
              <option value="">Selecione…</option>
              <?php foreach ($opts as $o): ?>
                <option value="<?= h($o['titulo']) ?>" <?= $sv===$o['titulo']?'selected':''; ?>><?= h($o['titulo']) ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Localidade</label>
          <input type="text" name="localidade" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="form-label">Prazo</label>
          <input type="text" name="prazo" class="form-control" placeholder="ex.: 2-3 meses">
        </div>
        <div class="col-md-3">
          <label class="form-label">Orçamento estimado (€)</label>
          <input type="number" step="0.01" min="0" name="orcamento_estimado" class="form-control">
        </div>
        <div class="col-12">
          <label class="form-label">Mensagem</label>
          <textarea name="mensagem" class="form-control" rows="4" placeholder="Descreva o seu projeto"></textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label">Anexo (jpg, png, pdf – máx. 5MB)</label>
          <input type="file" name="anexo" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="consent" id="consentOrc" value="1" required>
            <label class="form-check-label" for="consentOrc">Concordo com o tratamento dos meus dados segundo a Política de Privacidade.</label>
          </div>
        </div>
        <?php if(defined('RECAPTCHA_SITE_KEY') && RECAPTCHA_SITE_KEY): ?>
          <div class="col-12">
            <div class="g-recaptcha" data-sitekey="<?= h(RECAPTCHA_SITE_KEY) ?>"></div>
          </div>
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <?php endif; ?>
        <div class="col-12 d-grid d-md-inline">
          <button class="btn btn-primary">Enviar pedido</button>
        </div>
      </form>
    </div>
  </div>
</main>

<?php include __DIR__ . '/componentes/footer.php'; ?>
