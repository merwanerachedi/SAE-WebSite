<?php require 'views/layout/header.php'; ?>
<div class="row justify-content-center my-5">
  <div class="col-md-6 col-lg-5">
    <div class="card-marco auth-card p-4 p-md-5">
      <div class="text-center mb-4">
        <i class="bi bi-person-plus text-dore display-4 mb-3 d-block"></i>
        <h2 style="font-family: var(--font-display);">Créer un compte</h2>
        <p class="text-muted small">Rejoignez la famille Marco</p>
      </div>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger shadow-sm border-0"><i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="<?= BASE_URL ?>?action=register_post" id="registerForm" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Nom</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Prénom</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="text" class="form-control" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Mot de passe</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" name="password" id="regPassword" minlength="6" required>
          </div>
          <div class="form-text small"><i class="bi bi-info-circle me-1"></i>Minimum 6 caractères.</div>
        </div>
        <div class="mb-4">
          <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Confirmer</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
            <input type="password" class="form-control" name="confirm" id="regConfirm" required>
          </div>
          <div class="invalid-feedback">Les mots de passe ne correspondent pas.</div>
        </div>
        <button type="submit" class="btn btn-marco w-100 rounded-pill py-2">S'inscrire</button>
      </form>
      <div class="text-center mt-4 pt-3 border-top" style="border-color: var(--color-gris-clair) !important;">
        <p class="text-muted small mb-0">Déjà un compte ? <a href="<?= BASE_URL ?>?action=login" class="fw-semibold">Se connecter</a></p>
      </div>
    </div>
  </div>
</div>
<?php require 'views/layout/footer.php'; ?>
