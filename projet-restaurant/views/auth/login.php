<?php require 'views/layout/header.php'; ?>
<div class="row justify-content-center my-5">
  <div class="col-md-5 col-lg-4">
    <div class="card-marco auth-card p-4 p-md-5">
      <div class="text-center mb-4">
        <i class="bi bi-person-circle text-dore display-4 mb-3 d-block"></i>
        <h2 style="font-family: var(--font-display);">Connexion</h2>
        <p class="text-muted small">Bienvenue chez Marco</p>
      </div>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger shadow-sm border-0"><i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="<?= BASE_URL ?>?action=login_post" id="loginForm" novalidate>
        <div class="mb-4">
          <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required placeholder="votre@email.com">
          </div>
        </div>
        <div class="mb-4">
          <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Mot de passe</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" name="password" required placeholder="••••••••">
          </div>
        </div>
        <button type="submit" class="btn btn-marco w-100 rounded-pill py-2 mt-2">Se connecter</button>
      </form>
      <div class="text-center mt-4 pt-3 border-top" style="border-color: var(--color-gris-clair) !important;">
        <p class="text-muted small mb-0">Pas encore de compte ? <a href="<?= BASE_URL ?>?action=register" class="fw-semibold">Créer un compte</a></p>
      </div>
    </div>
  </div>
</div>
<?php
$extraJs = 'public/js/validation.js';
require 'views/layout/footer.php';
?>
