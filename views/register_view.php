<?php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/recaptcha.php';
$menuItems = get_menu_items($conn, 'principal');
$page_title = 'Criar conta · Constrói Spa & Pool';
$page_description = 'Cria a tua conta para gerir pedidos, preferências e contactos.';
$body_classes = 'auth-page register-page';
include __DIR__ . '/../componentes/header.php';
?>

<section class="bg-gradiente py-4 auth-page">
  <div class="container" style="max-width: 860px;">
    <div class="card shadow-sm border-0">
      <div class="card-body p-4 p-md-5">
        <h1 class="h3 mb-3 text-center text-primary">Criar conta</h1>
        <?php if (!empty($_SESSION['alert'])): ?>
          <div class="alert alert-<?= $_SESSION['alert']['type'] ?> text-center">
            <?= htmlspecialchars($_SESSION['alert']['msg']) ?>
          </div>
        <?php unset($_SESSION['alert']); endif; ?>
        <p class="text-center text-muted mb-4">Preenche os dados para te registares</p>

  <form method="POST" action="../register.php" novalidate>
          <?php gerarCSRF(); ?>

          <div class="row g-3">
            <div class="col-md-6">
              <input type="text" class="form-control required-hover" name="usuario" placeholder="Utilizador" aria-label="Utilizador" minlength="3" title="Nome de utilizador (mín. 3 caracteres)" required>
            </div>
            <div class="col-md-6">
              <input type="email" class="form-control required-hover" name="email" placeholder="email@exemplo.com" aria-label="Email" required>
            </div>

            <div class="col-md-6">
              <div class="input-group">
                <input type="password" class="form-control required-hover pw-live" name="senha" id="regSenha" placeholder="Senha" aria-label="Senha" minlength="8" maxlength="64" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&\-_^#()+=]).{8,64}$" title="Mín. 8 caracteres e pelo menos: uma maiúscula, um número e um símbolo" required autocomplete="off">
                <button class="btn btn-outline-secondary" type="button" onclick="Constroi.togglePass('regSenha', this)">Mostrar</button>
              </div>
            </div>

            <div class="col-md-6">
              <input type="text" class="form-control required-hover" name="nome_completo" placeholder="Nome completo" aria-label="Nome completo" minlength="3" title="Nome completo (mín. 3 caracteres)" required>
            </div>

            
            <div class="col-md-4">
              <input type="text" class="form-control" name="localidade" placeholder="Localidade" aria-label="Localidade">
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control" name="andar" placeholder="Andar" aria-label="Andar">
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control no-hint" name="porta" placeholder="Porta" aria-label="Porta">
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control" name="numero" placeholder="Nº" aria-label="Nº" pattern="^[0-9A-Za-z]{1,5}$" title="Número da porta (1–5 caracteres, letras ou dígitos)" maxlength="5">
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control" name="cod_postal" placeholder="Código Postal" aria-label="Código Postal" pattern="^\d{4}-\d{3}$" title="Formato: 1234-567" maxlength="8">
            </div>

            <div class="col-md-2">
              <input type="text" class="form-control" name="porta" placeholder="Porta" aria-label="Porta">
            </div>

            <div class="col-md-3">
              <input type="text" class="form-control" name="telefone" placeholder="Telefone" aria-label="Telefone" pattern="^\+?\d{9,15}$" title="Telefone (9–15 dígitos, pode incluir +)">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" name="contribuinte" placeholder="Contribuinte" aria-label="Contribuinte" pattern="^\d{9}$" title="NIF com 9 dígitos" maxlength="9">
            </div>

            <?php if (recaptcha_is_configured()): ?>
              <div class="col-12">
                <div class="g-recaptcha" data-sitekey="<?= h(RECAPTCHA_SITE_KEY) ?>"></div>
              </div>
            <?php endif; ?>
          </div>

          <div class="d-grid gap-2 mt-4">
            <button class="btn btn-primary" type="submit">Registar</button>
            <a href="./login_view.php" class="btn btn-outline-secondary">Já tenho conta</a>
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
