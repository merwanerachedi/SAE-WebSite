<?php require 'views/layout/header.php'; ?>
<h2>Nouveau plat</h2>
<form method="POST" action="<?= BASE_URL ?>?action=plat_store" class="col-md-7">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Prix (€)</label>
            <input type="number" step="0.01" min="0" class="form-control" name="prix" required>
        </div>
        <div class="col mb-3">
            <label class="form-label">Catégorie</label>
            <select class="form-select" name="categorie_id" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="disponible" value="1" checked>
        <label class="form-check-label">Disponible</label>
    </div>
    <button type="submit" class="btn btn-dark">Créer</button>
    <a href="<?= BASE_URL ?>?action=plats_admin" class="btn btn-outline-secondary ms-2">Annuler</a>
</form>
<?php require 'views/layout/footer.php'; ?>
