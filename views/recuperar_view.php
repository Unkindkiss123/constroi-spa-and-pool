<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/recaptcha.php';
$menuItems = get_menu_items($conn, 'principal');
$page_title = 'Recuperar palavra-passe · Constrói Spa & Pool';
$page_description = 'Recebe um link para redefinir a tua palavra-passe.';
include __DIR__ . '/../componentes/header.php';
?>

<section class="bg-gradiente py-4 auth-page">
  <div class="container" style="max-width: 720px;">
    <div class="card shadow-sm border-0">
      <div class="card-body p-4 p-md-5">
        <h1 class="h4 mb-3 text-center text-primary">Recuperar palavra-passe</h1>
        <?php if (!empty($_SESSION['alert'])): $a = $_SESSION['alert']; unset($_SESSION['alert']); ?>
          <div class="alert alert-<?= h($a['type'] ?? 'info') ?> text-center"><?= h($a['msg'] ?? '') ?></div>
        <?php endif; ?>
        <?php if (defined('IS_LOCAL') && IS_LOCAL && !empty($_SESSION['reset_preview_link'])): ?>
          <div class="alert alert-warning text-center">
            Link de teste (DEV): <a href="<?= h($_SESSION['reset_preview_link']) ?>">Redefinir palavra‑passe</a>
          </div>
          <?php unset($_SESSION['reset_preview_link']); ?>
        <?php endif; ?>
        <p class="text-muted text-center">Escreve o teu email e enviaremos um link para redefinir a senha.</p>

  <form method="post" action="<?= h(url_for('/recuperar_password.php')) ?>">
          <?php gerarCSRF(); ?>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
          </div>
          <?php if (recaptcha_is_configured()): ?>
            <div class="mb-3">
              <div class="g-recaptcha" data-sitekey="<?= h(RECAPTCHA_SITE_KEY) ?>"></div>
            </div>
          <?php endif; ?>
          <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Enviar link</button>
            <a class="btn btn-outline-secondary" href="./login_view.php">Voltar ao login</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  </section>

<?php if (recaptcha_is_configured()): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<?php include __DIR__ . '/../componentes/footer.php'; ?>
