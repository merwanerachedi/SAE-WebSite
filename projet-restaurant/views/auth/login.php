<?php require 'views/layout/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h2 class="text-center mb-4">Connexion</h2>

        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>?action=login_post" id="loginForm" novalidate>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
        <p class="mt-3 text-center">Pas de compte ? <a href="<?= BASE_URL ?>?action=register">S'inscrire</a></p>
      </div>
    </div>
  </div>
</div>
<?php
$extraJs = 'public/js/validation.js';
require 'views/layout/footer.php';
?>
