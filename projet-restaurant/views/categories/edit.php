<?php require 'views/layout/header.php'; ?>
<h2>Modifier la catégorie</h2>
<form method="POST" action="/?action=categorie_update" class="col-md-6">
    <input type="hidden" name="id" value="<?= $categorie['id'] ?>">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($categorie['nom']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3"><?= htmlspecialchars($categorie['description'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn btn-dark">Enregistrer</button>
    <a href="/?action=categories" class="btn btn-outline-secondary ms-2">Annuler</a>
</form>
<?php require 'views/layout/footer.php'; ?>
