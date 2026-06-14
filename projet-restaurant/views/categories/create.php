<?php require 'views/layout/header.php'; ?>
<h2>Nouvelle categorie</h2>
<form method="POST" action="<?= BASE_URL ?>?action=categorie_store" class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-dark">Creer</button>
    <a href="<?= BASE_URL ?>?action=categories" class="btn btn-outline-secondary ms-2">Annuler</a>
</form>
<?php require 'views/layout/footer.php'; ?>
