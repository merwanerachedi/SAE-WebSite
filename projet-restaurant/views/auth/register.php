<?php require 'views/layout/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h2 class="text-center mb-4">Creer un compte</h2>

        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>?action=register_post" id="registerForm" novalidate>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Nom</label>
              <input type="text" class="form-control" name="nom"
                     value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
            </div>
            <div class="col mb-3">
              <label class="form-label">Prenom</label>
              <input type="text" class="form-control" name="prenom"
                     value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password"
                   id="regPassword" minlength="6" required>
            <div class="form-text">Minimum 6 caracteres.</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirmer</label>
            <input type="password" class="form-control" name="confirm" id="regConfirm" required>
            <div class="invalid-feedback">Les mots de passe ne correspondent pas.</div>
          </div>
          <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
        </form>
        <p class="mt-3 text-center">Deja un compte ? <a href="<?= BASE_URL ?>?action=login">Se connecter</a></p>
      </div>
    </div>
  </div>
</div>
<?php require 'views/layout/footer.php'; ?>
