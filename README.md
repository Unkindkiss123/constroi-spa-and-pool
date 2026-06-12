# 🌊 Constrói Spa & Pool (CSP)

Website institucional + backoffice para gestão de **orçamentos, produtos e serviços** da Constrói Spa & Pool.

> Identidade: azuis/turquesa (cartão de visita), logo C+P moderno, separadores em onda, tipografia coerente.  
> UX: header em gradiente, **pill ativo** com shimmer, hover suave, dark mode persistente.

---

## 📌 Roadmap (v2.0 — resumo)

- **Fase 1 — Frontend Base**
  - Header/Footer polidos (claro/escuro), tipografia consistente.
  - Micro-animações: roll-in, ripple, shimmer.
- **Fase 1.2 — Orçamentos (Funcional)**: formulário público (CSRF, honeypot, reCAPTCHA), gravação, listagem backoffice.
- **Fase 1.4 — PDFs**: proposta com branding aquático, validade e assinatura.
- **Fase 1.5 — Notificações**: emails automáticos (envio, lembretes, aceitação/expiração).
- **Fase 1.6–1.8 — UX Premium**: cadências, microcopy por estado, polimento visual.
- **Fase 2**: páginas de produtos/serviços avançadas (storytelling, comparativos).
- **Fase 3**: backoffice avançado (CRUD serviços/inventário, métricas).

---

## 🏗️ Estrutura do Projeto

constroi_spa_and_pool/
├── componentes/ → header.php, footer.php, blocos partilhados
├── includes/ → config, segurança (CSRF, reCAPTCHA, mailer…), helpers
├── views/ → páginas (home, produtos, contactos, perfil, admin/*)
├── public/ → css, js, imagens
├── database/ → schema.sql (e seeds)
├── logs/ → erros e mailer
└── vendor/ → Composer (PHPMailer, etc.)

markdown
Copiar código

Notas:
- Apresentação em `views/` (HTML/PHP com `h()` para escapar).
- Lógica/segurança em `includes/`.
- Componentes partilhados em `componentes/`.

---

## 🚀 Instalação Local

1. **XAMPP**: iniciar Apache + MySQL.  
2. **Clone/ZIP** → `C:\xampp\htdocs\constroi_spa_and_pool`  
3. **Base de dados**:
   - Criar BD (nome em `includes/config.php`, por omissão `constroi_spa_pool`).
   - Importar `database/schema.sql`.
4. **Abrir**: `http://localhost/constroi_spa_and_pool`

---

## 🔧 Configuração

- **Ambiente** em `includes/config.php`:
  - `APP_ENV='local'|'production'` · `IS_LOCAL` (atalho DEV)  
  - `BASE_URL` (ex.: `http://localhost/constroi_spa_and_pool/`)
- **reCAPTCHA**: `RECAPTCHA_SITE_KEY/SECRET_KEY` (podes usar chaves de teste do Google em DEV).
- **Emails (PHPMailer)**:
  - `MAIL_DRIVER`: `none` | `mail` | `smtp` (recomendado).
  - SMTP: `SMTP_HOST/PORT/USER/PASS/SECURE/AUTH`.
  - Teste: `http://localhost/constroi_spa_and_pool/teste_mailer.php`  
  - Logs: `logs/mailer.log`.

---

## 🔐 Segurança (resumo)

- **CSRF** universal (tokens + 400 em falha).  
- **reCAPTCHA** em flows sensíveis (login, registo, contacto, recuperar password).  
- **Password hashing** com `password_hash()`.  
- **XSS**: `h()` em saídas.  
- **Sessão reforçada**: `HttpOnly`, `SameSite=Lax` (+ `Secure` em HTTPS).  
- **Rate-limit** suave em POSTs de perfil.  
- **PRG + flashes** para UX previsível (redirect após POST).  

Ficheiros–chave:
- CSRF: `includes/csrf.php`  
- reCAPTCHA: `includes/recaptcha.php`  
- Perfil: `includes/perfil_update.php` + `views/perfil_view.php`  
- Mailer: `includes/mailer.php`

---

## 🧩 Dependências (Composer)

Instalar:
```bash
composer install
# ou, se for a primeira vez:
composer require phpmailer/phpmailer
O autoload é usado por includes/mailer.php.

🍪 Cookies & Tema
Banner de Cookies ativo (localStorage csp_cookie_consent), página politica-cookies.php.

Tema claro/escuro persistente (localStorage csp_theme), 1 init (head) + 1 toggle (no footer).

🧪 Smoke Tests rápidos
Header (gradiente): links brancos, hover com véu suave, pill ativo cheio (não apenas border).

Tema: alterna e persiste entre páginas.

Cookies: banner só até aceitar.

Perfil: POST → redirect com flash; CSRF inválido → 400.

📄 Licença & Créditos
© 2025 Constrói Spa & Pool — Desenvolvido por Nuno Matos.
Projeto académico (CodeMaster — Full Stack Web Developer).

yaml
Copiar código

---

## Comandos para atualizar o README e fazer push

> Executa na pasta do projeto `C:\xampp\htdocs\constroi_spa_and_pool`:

```powershell
# 1) Abrir o README para substituíres o conteúdo:
notepad README.md

# 2) Depois de gravares:
git add README.md
git commit -m "docs: README fundido (branding + técnico) para CSP"
git push