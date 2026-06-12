<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
$menuItems = get_menu_items($conn, 'principal');
$page_title = 'Redefinir palavra-passe · Constrói Spa & Pool';
$page_description = 'Define uma nova palavra-passe segura.';
$token = isset($_GET['token']) ? (string)$_GET['token'] : '';
include __DIR__ . '/../componentes/header.php';
?>

<section class="bg-gradiente py-4 auth-page">
  <div class="container" style="max-width: 720px;">
    <div class="card shadow-sm border-0">
      <div class="card-body p-4 p-md-5">
        <h1 class="h4 mb-3 text-center text-primary">Redefinir palavra-passe</h1>
        <?php if (!empty($_SESSION['alert'])): $a = $_SESSION['alert']; unset($_SESSION['alert']); ?>
          <div class="alert alert-<?= h($a['type'] ?? 'info') ?> text-center"><?= h($a['msg'] ?? '') ?></div>
        <?php endif; ?>
        <p class="text-muted text-center">Escolhe uma nova palavra-passe.</p>

  <form method="post" action="<?= h(url_for('/redefinir_password.php')) ?>">
          <?php gerarCSRF(); ?>
          <input type="hidden" name="token" value="<?= h($token) ?>">
          <div class="mb-3">
            <label class="form-label">Nova palavra-passe</label>
            <div class="input-group">
              <input type="password" name="senha" id="newPass" class="form-control" minlength="8" maxlength="64" required autocomplete="off" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&\-_^#()+=]).{8,64}$" title="Mín. 8 caracteres e pelo menos: uma maiúscula, um número e um símbolo">
              <button class="btn btn-outline-secondary" type="button" onclick="window.Constroi && Constroi.togglePass('newPass', this)" aria-label="Mostrar/ocultar palavra‑passe">Ver</button>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirmar palavra-passe</label>
            <div class="input-group">
              <input type="password" name="senha2" id="newPass2" class="form-control" minlength="8" maxlength="64" required autocomplete="off">
              <button class="btn btn-outline-secondary" type="button" onclick="window.Constroi && Constroi.togglePass('newPass2', this)" aria-label="Mostrar/ocultar palavra‑passe">Ver</button>
            </div>
          </div>
          <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Guardar nova senha</button>
            <a class="btn btn-outline-secondary" href="./login_view.php">Voltar ao login</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  </section>

<?php include __DIR__ . '/../componentes/footer.php'; ?>
